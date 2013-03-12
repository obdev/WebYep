$(document).ready(function(){
    WY = window.WY || {};
    WY.menu = {
        selectedEntry: 0,
        model: {},
        getMenuItem: function(menuID) {
            for(var i=0; i<this.model.content.length; i++) {
                if (this.model.content[i].id == menuID) {
                    return this.model.content[i];
                }
            }
            return {};
        },
        getMenuIndex: function(menuID) {
            for(var i=0; i<this.model.content.length; i++) {
                if (this.model.content[i].id == menuID) {
                    return i;
                }
            }
            return -1;
        },
        getParent: function(menuID) {
            if (menuID && this.hasParent(menuID)) {
                var idx = this.getMenuIndex(menuID);
                var lvl = this.model.content[idx].level;
                for (var i = idx - 1; i >= 0; i--) {
                    if (this.model.content[i].level == lvl - 1) {
                        return this.model.content[i];
                    }
                }
            } else {
                return false;
            }
        },
        hasParent: function(menuID) {
            return this.model.content[this.getMenuIndex(menuID)].level !== 0;
        },
        hasHiddenParents: function(menuID) {
            var idx = this.getMenuIndex(menuID);
            var lvl = this.model.content[idx].level;
            if (lvl == 0) {
                return false; // root item -> has no parents
            }
            for (var i = idx; i >= 0; --i) {
                var current = this.model.content[i];
                if (current.level == 0) { // stop at first root level item
                    return !current.visible;
                } else if (current.level >= lvl) {
                    continue;
                } else {
                    lvl--;
                    if (!current.visible) {
                        return true;
                    }
                }
            }
            return false;
        },
        getChildren: function(menuID) {
            if (!menuID) return false;
            var index = this.getMenuIndex(menuID);
            var level = this.model.content[index].level;
            var children = [];
            if ((index + 1) == this.model.content.length) return children;
            while (this.model.content[++index].level > level) {
                children.push(this.model.content[index]);
                if ((index + 1) == this.model.content.length) {
                    break;
                }
            }
            return children;
        },
        getPreviousSibling: function() {
            var i = this.getSelectedIndex();
            if (i > 0) {
                for (var j = i - 1; j >= 0; j--) {
                    if (this.model.content[j].level < this.model.content[i].level) return false; // already at parent-level
                    if (this.model.content[j].level == this.model.content[i].level) return this.model.content[j];
                }
            }
            return false; // nothing selected, or no previous sibling
        },
        getNextSibling: function() {
            var i = this.getSelectedIndex();
            if (i != -1 && i < this.model.content.length - 1) {
                for (var j = i + 1; j < this.model.content.length; j++) {
                    if (this.model.content[j].level < this.model.content[i].level) return false; // already at parent-level
                    if (this.model.content[j].level == this.model.content[i].level) return this.model.content[j];
                }
            }
            return false;  // nothing selected, or last child
        },
        getSelectedItem: function() {
            return this.getMenuItem(this.selectedEntry);
        },
        getSelectedIndex: function() {
            return this.getMenuIndex(this.selectedEntry);
        },
        getHTML: function(M) { // M is an entry in WY.menu.model.content[]
            var index = this.getMenuIndex(M.id);
            var toggle = '';
            var hasChildren = false;
            if (index < this.model.content.length - 1) {
                if (this.model.content[index].level < this.model.content[index+1].level) {
                    hasChildren = true;
                    toggle = '<span class="toggle"><\/span>';
                }
            }
            var visible = M.tmpVisible == 1 ? '' : ' hidden';
            var selected = M.id == this.selectedEntry ? ' selected' : '';
            var hideChildren = M.hideChildren ? ' class="hideChildren noNesting"' : '';
            var linkTT, linkTXT = '';
            if (M.link) {
                linkTT = M.link;
                linkTXT = '<br \/><span class="link">'+M.link+'<\/span>';
            } else {
                linkTT = this.model.baseUrl;
            }
            return '<li id="menu_'+M.id+'"'+hideChildren+'><div class="WY_EditorMenuItem'+visible+selected+'" title="'+linkTT+'"><span class="title">'+M.text+'<\/span>'+toggle+linkTXT+'<\/div><\/li>';
        },
        sliceMenu: function(slices) {
            var newModel = [];
            for (var j in slices) {
                for (var i = slices[j][0]; i<= slices[j][1]; i++) {
                    this.model.content[i].level += (slices[j].length == 3 ? slices[j][2] : 0);
                    newModel.push(this.model.content[i]);
                }
            }
            return newModel;
        },
        moveSelectionUp: function() { // trade place with previous sibling
            this.setSelection();
            if (!this.selectedEntry) return; // nothing selected --> abort
            var prev = this.getPreviousSibling();
            if (!prev) return; // no previous sibling
            var previousStartIndex = this.getMenuIndex(prev.id);
            var previousEndIndex = previousStartIndex + this.getChildren(prev.id).length;
            var selectedStartIndex = this.getMenuIndex(this.selectedEntry);
            var selectedEndIndex = selectedStartIndex + this.getChildren(this.selectedEntry).length;
            var slices = [[0,previousStartIndex-1]                         // copy old[0]-old[(index(prev)-1]
                         ,[selectedStartIndex,selectedEndIndex]            // copy selected + children
                         ,[previousStartIndex,previousEndIndex]            // copy old[index(prev)]-old[index(prev.lastChild)]
                         ,[selectedEndIndex+1,this.model.content.length-1] // copy old[index(selected)+children+1]-old[last]
                         ];
            this.model.content = this.sliceMenu(slices);
            this.buildDOM('#WY_InsertMenuItemsHere');
            this.scrollIntoView();
        },
        moveSelectionDown: function() { // trade place with next sibling
            this.setSelection();
            if (!this.selectedEntry) return; // nothing selected --> abort
            var nextSibling = this.getNextSibling();
            if (!nextSibling) return; // no next sibling
            var selectedStartIndex = this.getMenuIndex(this.selectedEntry);
            var selectedEndIndex = selectedStartIndex + this.getChildren(this.selectedEntry).length;
            var nextStartIndex = this.getMenuIndex(nextSibling.id);
            var nextEndIndex = nextStartIndex + this.getChildren(nextSibling.id).length;
            var slices = [[0,selectedStartIndex-1]
                         ,[nextStartIndex,nextEndIndex]
                         ,[selectedStartIndex,selectedEndIndex]
                         ,[nextEndIndex+1,this.model.content.length-1]
                         ];
            this.model.content = this.sliceMenu(slices);
            this.buildDOM('#WY_InsertMenuItemsHere');
            this.scrollIntoView();
        },
        moveSelectionLeft: function() { // make selection sibling of parent
            this.setSelection();
            if (!this.selectedEntry) return; // nothing selected --> abort
            var parentEntry = this.getParent(this.selectedEntry);
            if (!parentEntry) return; // root element --> no parent
            var selectedStartIndex = this.getMenuIndex(this.selectedEntry);
            var selectedEndIndex = selectedStartIndex + this.getChildren(this.selectedEntry).length;
            var parentStartIndex = this.getMenuIndex(parentEntry.id);
            var parentEndIndex = parentStartIndex + this.getChildren(parentEntry.id).length;
            var slices = [[0,selectedStartIndex-1]
                         ,[selectedEndIndex+1,parentEndIndex]
                         ,[selectedStartIndex,selectedEndIndex,-1]
                         ,[parentEndIndex+1,this.model.content.length-1]
                         ];
            this.model.content = this.sliceMenu(slices);
            this.buildDOM('#WY_InsertMenuItemsHere');
            this.scrollIntoView();
        },
        moveSelectionRight: function() {     // make selection child of previous sibling
            this.setSelection();
            if (!this.selectedEntry) return; // nothing selected --> abort
            var prev = this.getPreviousSibling();
            if (!prev) return;               // no previous sibling
            if (prev.hideChildren) return;   // don't move under hidden tree
            var previousStartIndex = this.getMenuIndex(prev.id);
            var previousEndIndex = previousStartIndex + this.getChildren(prev.id).length;
            var selectedStartIndex = this.getMenuIndex(this.selectedEntry);
            var selectedEndIndex = selectedStartIndex + this.getChildren(this.selectedEntry).length;
            var slices = [[0,previousEndIndex]
                         ,[selectedStartIndex,selectedEndIndex,1]
                         ,[selectedEndIndex+1,this.model.content.length-1]
                         ];
            this.model.content = this.sliceMenu(slices);
            this.buildDOM('#WY_InsertMenuItemsHere');
            this.scrollIntoView();
        },
        addChild: function(menuID) {
            var newMenuEntry = {id:0, level:0, visible:1, text:"New Menu Entry", link:""};
            this.model.lastInsertId++;
            newMenuEntry.id = this.model.lastInsertId;
            if (!this.model.content) {
                this.model.content = []; // workaround to trick GC
            }
            if (menuID == 0) { // if nothing selected, append to existing entries @ lvl 0
                this.model.content.push(newMenuEntry);
            } else {
                var idx = this.getMenuIndex(menuID);
                this.model.content[idx].hideChildren = 0;
                var newModel = [];
                newMenuEntry.level = this.model.content[idx].level + 1;
                for (var i = 0; i <= idx; i++) {
                    newModel.push(this.model.content[i]);
                }
                newModel.push(newMenuEntry);
                for (i = idx + 1; i < this.model.content.length; i++) {
                    newModel.push(this.model.content[i]);
                }
                this.model.content = newModel;
            }
            this.selectedEntry = this.model.lastInsertId;
            this.buildDOM('#WY_InsertMenuItemsHere');
            this.setSelection();
            this.scrollIntoView();
        },
        addSibling: function(menuID) {
            var newMenuEntry = {id:0, level:0, visible:1, text:"New Menu Entry", link:""};
            this.model.lastInsertId++;
            newMenuEntry.id = this.model.lastInsertId;
            if (!this.model.content) this.model.content = []; // workaround to trick GC
            if (menuID == 0) { // if nothing selected, append to existing entries @ lvl 0
                this.model.content.push(newMenuEntry);
            } else {
                var idx = this.getMenuIndex(menuID);
                var newModel = [];
                newMenuEntry.level = this.model.content[idx].level;
                for (var i = 0; i <= idx; i++) { // copy everything, including selected entry
                    newModel.push(this.model.content[i]);
                }
                while (i < this.model.content.length && this.model.content[i].level > newMenuEntry.level) { // copy children of selected entry
                    newModel.push(this.model.content[i]);
                    i++;
                }
                newModel.push(newMenuEntry); // add new menu item
                while (i < this.model.content.length) { // copy rest of old menu
                    newModel.push(this.model.content[i]);
                    i++;
                }
                this.model.content = newModel;
            }
            this.selectedEntry = this.model.lastInsertId;
            this.buildDOM('#WY_InsertMenuItemsHere');
            this.setSelection();
            this.scrollIntoView();
        },
        deleteSubtree: function() {
            var entry = this.selectedEntry;
            if (!entry) return;
            var candidates = []; candidates.push(entry);
            var submenues = this.getChildren(entry);
            if (!confirm(submenues.length ? this.messages.deleteMany : this.messages.deleteOne)) return;
            for (var i = 0; i < submenues.length; i++) {
                candidates.push(submenues[i].id);
            }
            var survivors = [], M = this.model.content; var copy;
            for (var i = 0; i < M.length; i++) {
                copy = true;
                for (var j = 0; j < candidates.length; j++) {
                    if (M[i].id == candidates[j]) {
                        copy = false; // don't copy this entry
                    }
                }
                if (copy) {
                    survivors.push(M[i]);
                }
            }
            this.model.content = survivors;
            this.buildDOM('#WY_InsertMenuItemsHere');
            this.clearSelection();
        },
        clearSelection: function() {
            $('#WY_EditMenuTitle').val('');
            $('#WY_EditMenuLink').val('');
            $('#WY_EditMenuVisible').attr('checked',false);
            this.selectedEntry = 0;
        },
        setSelection: function() {
            if (!this.selectedEntry) {
                this.clearSelection();
                return;
            }
            var menuEntry = this.getMenuItem(this.selectedEntry);
            var checked = menuEntry.visible ? 'checked' : false;
            $('#WY_EditMenuVisible').attr('checked',checked);
            $('#WY_EditMenuLink').val(menuEntry.link);
            $('#WY_EditMenuTitle').val(menuEntry.text).focus().select();
        },
        scrollIntoView: function() {
            if (!this.model.content.length) {
                return; // no entries, nothing to scroll
            }
            if (!this.selectedEntry) {
                return; // no entry selected, nothing to scroll
            }
            $("#WY_EditArea").scrollTop(this.lastScrollPosition); // restore offset, so list doesn't 'jump'
            var list = {};
            list.offset = $("#WY_EditArea ul").offset().top;
            list.height = $("#WY_EditArea").height();
            list.scroll = $("#WY_EditArea").scrollTop();
            var selectedEntry = {};
            selectedEntry.offset = $(".selected").offset().top - list.offset;
            selectedEntry.height = $(".selected").height();
            if (selectedEntry.offset < list.scroll) {
                $("#WY_EditArea").scrollTop(selectedEntry.offset);
            }
            if ((list.height + list.scroll - selectedEntry.height) < selectedEntry.offset) {
                $("#WY_EditArea").scrollTop(selectedEntry.offset - list.height + selectedEntry.height + 3);
            }
            if (this.lastScrollPosition != $("#WY_EditArea").scrollTop()) {
                this.lastScrollPosition = $("#WY_EditArea").scrollTop();
            }
        },
        // align model to DOM
        reorderModel: function() {
            var serialized = $('#WY_InsertMenuItemsHere').nestedSortable('serialize').split('&');
            var newModel = [], tmpModel = [];
            for (var i = 0; i < serialized.length; i++) {
                var tmp = serialized[i].match(/menu\[(\d+)\]=(\d+|root)/);
                var mID = tmp[1];
                var pID = tmp[2] == 'root' ? 0 : tmp[2];
                newModel.push(this.getMenuItem(mID));
                tmpModel[mID] = pID;
                newModel[i].level = this.getNestingDepth(tmpModel, mID);
            }
            this.model.content = newModel;
            this.buildDOM('#WY_InsertMenuItemsHere');
            this.scrollIntoView();
        },
        toggleVisibility: function(menuEntry) { // menuEntry is a jQuery object <div>
            WY.menu.selectedEntry = parseInt(menuEntry.parent().attr('id').replace('menu_',''));
            var parentList = menuEntry.parent();
            if (parentList.hasClass('hideChildren')) {
                parentList.removeClass('hideChildren noNesting');
                this.getSelectedItem().hideChildren = 0;
            } else {
                parentList.addClass('hideChildren noNesting');
                this.getSelectedItem().hideChildren = 1;
            }
        },
        getNestingDepth: function(M, mID) {
            return M[mID] == 0 ? 0 : this.getNestingDepth(M, M[mID]) + 1;
        },
        buildDOM: function(rootElement) { // at this point we have a correct model
            this.lastScrollPosition = $("#WY_EditArea").scrollTop();
            var domParent = [$(rootElement).empty()], lastLevel = 0, lastChild = null;
            for (var i=0; i<this.model.content.length; i++) {
                var mmc = this.model.content[i];
                if (mmc.level > lastLevel) { // indent
                    newUL = document.createElement('ul');
                    lastChild.append(newUL);
                    lastLevel = mmc.level;
                    domParent[mmc.level] = $(newUL);
                }
                lastLevel = mmc.level;
                mmc.tmpVisible = this.hasHiddenParents(mmc.id) ? 0 : mmc.visible;
                domParent[mmc.level].append(this.getHTML(mmc));
                lastChild = $($.find("#menu_"+mmc.id));
            }
            // click handlers for every menu entry
            $('.WY_EditorMenuItem').bind('click', function(){
                $('.WY_EditorMenuItem').removeClass('selected');
                $(this).addClass('selected');
                WY.menu.selectedEntry = parseInt($(this).parent().attr('id').replace('menu_',''));
                $('#WY_EditMenuTitle').val(WY.menu.getSelectedItem().text).focus().select(); // get menu title
                $('#WY_EditMenuLink').val(WY.menu.getSelectedItem().link);   // get link
                $('#WY_EditMenuVisible').attr('checked', WY.menu.getSelectedItem().visible ? 'checked' : false);
                WY.menu.lastScrollPosition = $("#WY_EditArea").scrollTop();
                WY.menu.scrollIntoView();
            });
            $('.WY_EditorMenuItem').bind('dblclick', function(){
                WY.menu.toggleVisibility($(this));
            });
            // click handler for toggle button (+/-)
            $('span.toggle').bind('click', function(){
                WY.menu.toggleVisibility($(this).parent());
            });
        },
        toString: function() {
            // {id:1,  level:0, visible:1, text:"Objective Development", link:"http://www.obdev.at"}
            var menuEntries = [];
            var menuEntry = '';
            for (var i in this.model.content) {
                var m = this.model.content[i];
                menuEntries.push(m.id+'|#|'+m.level+'|#|'+m.visible+'|#|'+m.text+'|#|'+m.link);
            }
            return '|@|' + menuEntries.join('|§|') + '|@|' + this.model.lastInsertId;
        },
        adjust: function() {
            var winSize = WY.window.getSize();
            if (winSize.height < 400) winSize.height = 400;
            $("#WY_EditArea").css({"height":winSize.height -180});
        }
    };

    // DOM Constructor Fleet (not from Vogsphere)
    WY.menu.model = WY.temp.model;
    WY.menu.messages = WY.temp.messages;
    WY.menu.buildDOM('#WY_InsertMenuItemsHere');

    $('#WY_InsertMenuItemsHere').nestedSortable({
        disableNesting: 'noNesting',
        scrollSensitivity: 20,
        scrollSpeed: 1,
        forcePlaceholderSize: true,
        handle: 'div',
        items: 'li',
        opacity: .6,
        placeholder: 'placeholder',
        tabSize: 20,
        tolerance: 'pointer', // 'intersect' or 'pointer'
        toleranceElement: '> div',
        update: function() { WY.menu.reorderModel(); }
    });

    // EditField for title
    $('#WY_EditMenuTitle').bind('blur change keyup', function(){
        $('#menu_'+WY.menu.selectedEntry).children('div').children('span.title').text($(this).val()); // write to DOM
        WY.menu.getSelectedItem().text = $(this).val(); // write to model
    }).val('');

    // EditField for link
    $('#WY_EditMenuLink').bind('blur change keyup', function(){
        var domMenuItem = $('#menu_'+WY.menu.selectedEntry).children('div');
        if (domMenuItem.children("span.link").length == 0) {
            domMenuItem.append('<br \/><span class="link">#<\/span>');
            WY.menu.scrollIntoView();
        }
        domMenuItem.children('span.link').text($(this).val());
        domMenuItem.attr('title', $(this).val() ? $(this).val() : WY.menu.model.baseUrl);
        WY.menu.getSelectedItem().link = $(this).val();
    }).val('');

    // Checkbox for visibility
    $('#WY_EditMenuVisible').bind('change', function(){
        var entry = WY.menu.getSelectedItem();
        var idx = WY.menu.getMenuIndex(entry.id);
        var submenues = WY.menu.getChildren(entry.id);
        if($(this).attr('checked')) { // show entry
            if (WY.menu.hasHiddenParents(entry.id)) {
                alert(WY.menu.messages.noToggleInvisibleParent);
                $(this).attr('checked', false);
                return;
            }
            WY.menu.model.content[idx].visible = 1;
            $('#menu_'+WY.menu.selectedEntry).children('div').removeClass('hidden');
            for (var s in submenues) {
                if (submenues[s].visible) {
                    $('#menu_'+submenues[s].id).children('div').removeClass('hidden');
                }
            }
        } else { // hide entry
            WY.menu.model.content[idx].visible = 0;
            $('#menu_'+WY.menu.selectedEntry).children('div').addClass('hidden');
            for (var s in submenues) {
                //submenues[s].visible = 0;
                $('#menu_'+submenues[s].id).children('div').addClass('hidden');
            }
        }
    }).attr('checked',false);

    // --- Buttons to move selected entry around ----------------------------------------------------------
    $('#WY_EditorButtonUp').bind('click', function(){
        WY.menu.moveSelectionUp();
    });
    $('#WY_EditorButtonDown').bind('click', function(){
        WY.menu.moveSelectionDown();
    });
    $('#WY_EditorButtonLeft').bind('click', function(){
        WY.menu.moveSelectionLeft();
    });
    $('#WY_EditorButtonRight').bind('click', function(){
        WY.menu.moveSelectionRight();
    });

    // Button 'Add Sibling'
    $('#WY_EditMenuAddSibling').click(function(){
        WY.menu.addSibling(WY.menu.selectedEntry);
    });

    // Button 'Add Child'
    $('#WY_EditMenuAddChild').click(function(){
        WY.menu.addChild(WY.menu.selectedEntry);
    });

    // Button 'Delete'
    $('#WY_EditMenuDelete').click(function(){
        WY.menu.deleteSubtree();
    });

    // Button 'Cancel'
    $('#WY_EditorButtonCancel').click(function(){
        window.close();
    });

    // Button 'Save'
    $('#WY_EditorButtonSave').click(function(){
        $('#WY_EditorPostArea').val($('#WY_InsertMenuItemsHere').nestedSortable('serialize') + WY.menu.toString());
        $('#WY_EditForm').submit();
    });

    // Event handlers for body.onload and .onresize
    $(window).bind('resize', function(){
        WY.window.saveSize();
        WY.menu.adjust();
    });
    $(window).load(function(){
        WY.window.restoreSize();
        WY.menu.adjust();
    });
}); // end of $.ready()