var SimpleModal = Class.create();

if (typeof Effect == 'undefined')
  throw("simple-modal.js requires including script.aculo.us' effects.js library!");

SimpleModal.prototype = {
  //
  //  Initialize
  //
  initialize: function(options) {
    this.buttons = [];

    this.options = Object.extend({
      onAppend:      null,
      offsetTop:     null,
      overlayOpacity:.3,
      overlayColor:  "#000000",
      width:         400,
      draggable:     true,
      keyEsc:        true,
      overlayClick:  true,
      closeButton:   true, // X close button
      hideHeader:    false,
      hideFooter:    false,
      btn_ok:        "OK", // Label
      btn_cancel:    "Cancel", // Label
      template:"<div class=\"simple-modal-header\"> \
      <h1>{_TITLE_}</h1> \
      </div> \
      <div class=\"simple-modal-body\"> \
      <div class=\"contents\">{_CONTENTS_}</div> \
      </div> \
      <div class=\"simple-modal-footer\"></div>"
    }, options || {});
  },

  /**
   * public method showModal
   * Open Modal
   * @options: param to rewrite
   * @return node HTML
   */
  showModal: function() {
    var node = null;
    var self = this;

    // Inserisce Overlay
    this._overlay("show");

    // Switch different modal
    switch(this.options.model) {
      case "modal-ajax":
        node = this._drawWindow(this.options);
        this._loadContents({
          "url": self.options.param.url || "",
          "onRequestComplete": this.options.param.onRequestComplete
        });
        break;
      case "confirm":
        // Add button confirm
        this.addButton(this.options.btn_ok, "btn primary btn-margin", function() {
          // in oppose to original version, i'm not catching exceptions
          // i want to know what's eventually goes wrong
          self.options.callback();
          self.hideModal();
        });
        // Add button cancel
        this.addButton(this.options.btn_cancel, "btn secondary");
        node = this._drawWindow(this.options);
        break;
      case "modal":
        node = this._drawWindow(this.options);
        break;
      default:
        // Alert
        this.addButton(this.options.btn_ok, "btn primary");
        node = this._drawWindow(this.options);
    }
    if (node) {
      // Custom size Modal
	  node.setStyle({width: this.options.width+"px"});

      // Hide Header &&/|| Footer
      if (this.options.hideHeader) node.addClassName("hide-header");
      if (this.options.hideFooter) node.addClassName("hide-footer");

      // Add Button X
      if (this.options.closeButton) this._addCloseButton();

      // Enabled Drag Window
      if (this.options.draggable) {
        var headDrag = node.down(".simple-modal-header"), clicked = false, dx=0, dy=0;
        var updatePos = function(pos) {
          node.setStyle({"left": pos.x-dx+"px", "top": pos.y-dy+"px"});
        };
        var getMousePos = function(e) {
          return { 'x': e.pageX, 'y': e.pageY };
        };
        headDrag.observe('mousedown', function (e) {
          var mpos = getMousePos(e), cpos = node.cumulativeOffset();
          Event.stop(e);

          dx = mpos.x - cpos.left;
          dy = mpos.y - cpos.top;

          clicked = true;
        });
        headDrag.observe('mouseup', function (e) {
          Event.stop(e);
          clicked = false;
        });
        document.observe('mousemove', function (e) {
          Event.stop(e);
          if (clicked) updatePos(getMousePos(e));
        });

        // Set handle cursor
        headDrag.setStyle({"cursor":"move"});
        node.addClassName("draggable");
		
      }
      // Resize Stage
      this._display();
    }
  },

  /**
   * public method hideModal
   * Close model window
   * return
   */
  hideModal: function() {
    this._overlay('hide');
  },
  hide: function() {
    this._overlay('hide');
  },

  /**
   * private method _drawWindow
   * Rendering window
   * return node SM
   */
  _drawWindow:function(options) {
    // Add Node in DOM
    var node = new Element("div", {
      "class" : 'simple-modal',
      'id': 'simple-modal'
    });

    // Set Contents
    node.update(this._template(this.options.template, {"_TITLE_":options.title || "Untitled", "_CONTENTS_":options.contents || ""}));

    document.body.insert(node);

    // Add all buttons
    this._injectAllButtons();

    // Callback append
    if (this.options.onAppend) {
      this.options.onAppend.call(this);
    }
    return node;
  },

  /**
   * public method addButton
   * Add button to Modal button array
   * require @label:string, @classe:string, @clickEvent:event
   * @return node HTML
   */
  addButton: function(label, classe, clickEvent) {
    var self = this;
    var bt = new Element("a", {
      "title" : label,
      "class" : classe
    });
    bt.update(label);
    bt.observe('click', clickEvent ? function(e) { clickEvent.call(self, e); } : function() { self.hideModal(); });

    this.buttons.push(bt);
    return this;
  },

  /**
   * private method _injectAllButtons
   * Inject all buttons in simple-modal-footer
   * @return
   */
  _injectAllButtons: function() {
    var footer = $$("#simple-modal .simple-modal-footer")[0];

    this.buttons.forEach(function(e) {
      footer.insert(e);
    });
  },

  /**
   * private method _addCloseButton
   * Inject Close botton (X button)
   * @return node HTML
   */
  _addCloseButton: function() {
    var self = this;
    var b = new Element("a", {
      "href" : '#',
      "class" : 'smclose'
    });
    b.update('×');
    b.observe('click', function(e) {
      self.hideModal();
      Event.stop(e);
    });

    $("simple-modal").insert(b);
    return b;
  },

  /**
   * private method _overlay
   * Create/Destroy overlay and Modal
   * @return
   */
  _overlay: function(status) {
    var self = this;
    switch(status) {
      case 'show':
        var overlay = new Element("div", {id: "simple-modal-overlay"});
        overlay.setStyle({"background-color": this.options.overlayColor, "opacity": 0});

        document.body.insert(overlay);

        new Effect.Opacity(overlay, {from: 0.0, to: this.options.overlayOpacity});

        // Behaviour
        if (this.options.overlayClick) {
          overlay.observe('click', function() { self.hideModal(); });
        }

        // Add Control Resize
        Event.observe(window, 'resize', function() { self._display(); });
        Event.observe(document, 'resize', function() { self._escape(); });
        break;

      case 'hide':
        // Remove Overlay
        $('simple-modal-overlay').remove();
        $('simple-modal').remove();
        Event.stopObserving(window, 'resize', function() { self._display(); });
        Event.stopObserving(document, 'resize', function() { self._escape(); });
    }
  },

  _escape: function(e) {
    if (e.keyCode == 27) self.hideModal();
  },

  /**
   * private method _loadContents
   * Async request for modal ajax
   * @return
   */
  _loadContents: function(param) {
    var self = this;
    // Set Loading
    $('simple-modal').addClassName("loading");
    // Match image file
    var re = new RegExp( /([^\/\\]+)\.(jpg|png|gif)$/i ), container = $('simple-modal');
    if (param.url.match(re)) {
      // Hide Header/Footer
      container.addClassName("hide-footer");
      // Remove All Event on Overlay
      $("simple-modal-overlay").stopObserving(); // Prevent Abort
      // Immagine
      var image = new Element("img", { 'src': param.url });
      image.observe('load', function() {
        image.setStyle({'opacity': 0});
        var content = container.removeClassName("loading").down(".contents").update('').insert(image);
        var dw = container.getWidth() - content.getWidth(), dh = container.getHeight() - content.getHeight();
        var width = image.getWidth()+dw, height  = image.getHeight()+dh;
        var viewport = self._viewport();

        new Effect.Morph(container, {
          style: {
            width: width + 'px',
            height: height + 'px',
            left: (viewport.width - width)/2 + 'px',
            top: (viewport.height - height)/2 + 'px'
          },
          duration: 0.2,
          afterFinish: function() {
            new Effect.Opacity(image, {from: 0.0, to: 1});
          }
        });
      });
    } else {
      var contents = $('simple-modal').down('.contents');
      var xmlhttp = new XMLHttpRequest();
      try {
        xmlhttp.open("GET", param.url);
        xmlhttp.onreadystatechange = function() {
          var container = contents.parentNode.parentNode.removeClassName("loading");
          if (xmlhttp.readyState == 4) {
            if (xmlhttp.status!=200 && xmlhttp.status!=0) {
              contents.update("loading failed");
              if (param.onRequestFailure) {
                param.onRequestFailure();
              }
            } else {
              contents.update(xmlhttp.responseText);
              if (param.onRequestComplete) {
                param.onRequestComplete();
              }
              self._display();
            }
          }
        }
        xmlhttp.send(null);
      } catch (e) {
        contents.update("loading failed");
      }
    }
  },

  /**
   * private method _display
   * Move interface
   * @return
   */
  _display: function() {
    // Update overlay
    var viewport = this._viewport();
    var overlay = $("simple-modal-overlay");
    var modal = $("simple-modal");

    if (overlay) overlay.setStyle(viewport);

    if (modal){
		modal.setStyle({
		  top: (this.options.offsetTop || (viewport.height - modal.getHeight())/2)+"px",
		  left: ((viewport.width - modal.getWidth())/2)+"px"
		});
	}
  },

  /**
   * private method _template
   * simple template by Thomas Fuchs
   * @return
   */
  _template:function(s,d) {
    for(var p in d) {
      s=s.replace(new RegExp('{'+p+'}','g'), d[p]);
    }
    return s;
  },

  _viewport: function () {
    return {
      width: window.innerWidth || (window.document.documentElement.clientWidth || window.document.body.clientWidth),
      height: window.innerHeight || (window.document.documentElement.clientHeight || window.document.body.clientHeight)
    };
  }
};
