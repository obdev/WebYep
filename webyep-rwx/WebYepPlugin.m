//
//  WebYepPlugin.m
//  WebYep
//
//  Created by Johannes Tiefenbrunner on 21.09.2006.
//  Copyright 2006 Objective Development Software GmbH. All rights reserved.
//
// Revision: $Id$

#import "WebYepPlugin.h"
#import "WYNSAlertAdditions.h"
#import "WYLocalizedBundle.h"
#import "WYLocalization.h"
#import "WYConstrainedContentView.h"
#import "WYNSBundleAdditions.h"
#import "WYNSStringAdditions.h"

#define PluginStructureVersion 3

#define RWPluginParamDisplayMode @"mode"
#define RWPluginParamDisplayModePreview @"preview"
#define RWPluginParamDisplayModeExport @"export"
#define RWPluginParamAttributes @"attributes"
#define RWPluginParamFilename @"name"

#define ContentFragmentFunctions @"functions"
#define ContentFragmentPageHeading @"page_heading"
#define ContentFragmentLoopStart @"loop_start"
#define ContentFragmentBlockHeading @"block_heading"
#define ContentFragmentFloatContainerStart @"float_container_start"
#define ContentFragmentFloatContainerEnd @"float_container_end"
#define ContentFragmentLeftPhoto @"left_photo"
#define ContentFragmentRightPhoto @"right_photo"
#define ContentFragmentText @"text"
#define ContentFragmentGallery @"gallery"
#define ContentFragmentAttachment @"attachment"
#define ContentFragmentCenterPhoto @"center_photo"
#define ContentFragmentBlockPadding @"block_padding"
#define ContentFragmentLoopEnd @"loop_end"
#define ContentFragmentInitCode @"init"
#define ContentFragmentSidebarMenu @"sidebar_menu"

#define DefaultFloatingPhotoWidth @"150"
#define DefaultFloatingPhotoPadding @"10"
#define DefaultCenterPhotoWidth @"300"
#define DefaultCenterPhotoPadding @"10"
#define DefaultBlockPadding @"20"
#define DefaultGalleryTNWidth @"60"
#define DefaultGalleryTNHeight @"60"
#define DefaultGalleryImageWidth @"0"
#define DefaultGalleryImageHeight @"0"
#define DefaultGalleryCellWidth @"100"
#define DefaultGalleryCellCount @"3"

#define LogonButtonOff 0
#define LogonButtonVisible 1
#define LogonButtonInvisible 2

#define FieldNameTagEnglish 1
#define FieldNameTagGerman 2

#define DefaultCharsetWarning @"WebYep_CharsetWarningOff"
#define Upgrade1_2Warning @"WebYep_Upgrade1_2WarningOff"
#define Upgrade2_3WarningInterval 3.0
#define CSSInfo @"WebYep_CSSInfoOff"

#define LSTRING(x) WYLocalizedStringFromTableInBundle(x, nil, pluginBundle)

static NSBundle *pluginBundle = nil;
//static lastFieldNameLanguageTag = FieldNameTagEnglish;
static NSTimeInterval lastUpgrade2_3WarningTime = 0;

@interface WebYepPlugin (Private)
- (id)_pageFromPageID:(NSString*)pageID;
- (NSString *)_getInitCode;
- (NSString *)_defaultCustomCSS;
@end


@implementation WebYepPlugin

//+ (void)initialize
//{
//   NSLog(@"Loading Introspector.bundle.");
//   NSBundle *b = [NSBundle bundleWithPath:@"/Users/johannes/Developer/_Builds/Debug/Introspector.bundle"];
//   [b load];
//   NSLog(@"bundle: %@", b);
//}

- (id)init
{
	self = [super init];
	if (self != nil) {
		if (_fieldNameLanguageTag == 0) _fieldNameLanguageTag = [NSBundle userPrefersGerman] ? FieldNameTagGerman:FieldNameTagEnglish;
		[self addObserver:self forKeyPath:@"_fieldNameLanguageTag" options:NSKeyValueObservingOptionNew context:nil];
		_logonButtonConfig = LogonButtonVisible;
		[self addObserver:self forKeyPath:@"_logonButtonConfig" options:NSKeyValueObservingOptionNew context:nil];
		_showPageHeading = YES;
		[self addObserver:self forKeyPath:@"_showPageHeading" options:NSKeyValueObservingOptionNew context:nil];
		_showBlockHeading = YES;
		[self addObserver:self forKeyPath:@"_showBlockHeading" options:NSKeyValueObservingOptionNew context:nil];
		_showLeftPhoto = YES;
		[self addObserver:self forKeyPath:@"_showLeftPhoto" options:NSKeyValueObservingOptionNew context:nil];
		_leftPhotoIsThumb = YES;
		[self addObserver:self forKeyPath:@"_leftPhotoIsThumb" options:NSKeyValueObservingOptionNew context:nil];
		_showRightPhoto = YES;
		[self addObserver:self forKeyPath:@"_showRightPhoto" options:NSKeyValueObservingOptionNew context:nil];
		_rightPhotoIsThumb = YES;
		[self addObserver:self forKeyPath:@"_rightPhotoIsThumb" options:NSKeyValueObservingOptionNew context:nil];
		_showAttachment = YES;
		[self addObserver:self forKeyPath:@"_showAttachment" options:NSKeyValueObservingOptionNew context:nil];
		_showText = YES;
		[self addObserver:self forKeyPath:@"_showText" options:NSKeyValueObservingOptionNew context:nil];
		_doRepeat = YES;
		[self addObserver:self forKeyPath:@"_doRepeat" options:NSKeyValueObservingOptionNew context:nil];
		_showCenterPhoto = YES;
		[self addObserver:self forKeyPath:@"_showCenterPhoto" options:NSKeyValueObservingOptionNew context:nil];
		_centerPhotoIsThumb = YES;
		[self addObserver:self forKeyPath:@"_centerPhotoIsThumb" options:NSKeyValueObservingOptionNew context:nil];
		_pageHeadingLevel = 1;
		[self addObserver:self forKeyPath:@"_pageHeadingLevel" options:NSKeyValueObservingOptionNew context:nil];
		_blockHeadingLevel = 2;
		[self addObserver:self forKeyPath:@"_blockHeadingLevel" options:NSKeyValueObservingOptionNew context:nil];
		_leftPhotoWidth = nil;
		[self addObserver:self forKeyPath:@"_leftPhotoWidth" options:NSKeyValueObservingOptionNew context:nil];
		_rightPhotoWidth = nil;
		[self addObserver:self forKeyPath:@"_rightPhotoWidth" options:NSKeyValueObservingOptionNew context:nil];
		_leftPhotoPadding = nil;
		[self addObserver:self forKeyPath:@"_leftPhotoPadding" options:NSKeyValueObservingOptionNew context:nil];
		_rightPhotoPadding = nil;
		[self addObserver:self forKeyPath:@"_rightPhotoPadding" options:NSKeyValueObservingOptionNew context:nil];
		_centerPhotoWidth = nil;
		[self addObserver:self forKeyPath:@"_centerPhotoWidth" options:NSKeyValueObservingOptionNew context:nil];
		_centerPhotoPadding = nil;
		[self addObserver:self forKeyPath:@"_centerPhotoPadding" options:NSKeyValueObservingOptionNew context:nil];
		_blockPadding = nil;
		[self addObserver:self forKeyPath:@"_blockPadding" options:NSKeyValueObservingOptionNew context:nil];
		[WYLocalizedBundle wy_loadLocalizedNibNamed:@"WebYep" owner:self];
		_showGallery = NO;
		[self addObserver:self forKeyPath:@"_showGallery" options:NSKeyValueObservingOptionNew context:nil];
		_galleryTNWidth = nil;
		[self addObserver:self forKeyPath:@"_galleryTNWidth" options:NSKeyValueObservingOptionNew context:nil];
		_galleryTNHeight = nil;
		[self addObserver:self forKeyPath:@"_galleryTNHeight" options:NSKeyValueObservingOptionNew context:nil];
		_galleryCellWidth = nil;
		[self addObserver:self forKeyPath:@"_galleryCellWidth" options:NSKeyValueObservingOptionNew context:nil];
		_galleryCellCount = nil;
		[self addObserver:self forKeyPath:@"_galleryCellCount" options:NSKeyValueObservingOptionNew context:nil];
		_showSidebarMenu = NO;
		[self addObserver:self forKeyPath:@"_showSidebarMenu" options:NSKeyValueObservingOptionNew context:nil];

		if (NSAppKitVersionNumber < 800.0) { // pre 10.4
			[_leftWidthField bind:@"value" toObject:self withKeyPath:@"_leftPhotoWidth" options:nil];
			[_rightWidthField bind:@"value" toObject:self withKeyPath:@"_rightPhotoWidth" options:nil];
			[_centerWidthField bind:@"value" toObject:self withKeyPath:@"_centerPhotoWidth" options:nil];
			[_galleryImageWidthField bind:@"value" toObject:self withKeyPath:@"_galleryImageWidth" options:nil];
			[_galleryImageHeightField bind:@"value" toObject:self withKeyPath:@"_galleryImageHeight" options:nil];
			[[_leftWidthField cell] setPlaceholderString:LSTRING(@"unchanged")];
			[[_rightWidthField cell] setPlaceholderString:LSTRING(@"unchanged")];
			[[_centerWidthField cell] setPlaceholderString:LSTRING(@"unchanged")];
			[[_galleryImageHeightField cell] setPlaceholderString:LSTRING(@"unchanged")];
			[[_galleryImageHeightField cell] setPlaceholderString:LSTRING(@"unchanged")];
		}
		else {
			// using @"NSNullPlaceholder" instead of NSNullPlaceholderBindingOption to be loadable on 10.3
			[_leftWidthField bind:@"value" toObject:self withKeyPath:@"_leftPhotoWidth" options:[NSDictionary dictionaryWithObject:LSTRING(@"unchanged") forKey:@"NSNullPlaceholder"]];
			[_rightWidthField bind:@"value" toObject:self withKeyPath:@"_rightPhotoWidth" options:[NSDictionary dictionaryWithObject:LSTRING(@"unchanged") forKey:@"NSNullPlaceholder"]];
			[_centerWidthField bind:@"value" toObject:self withKeyPath:@"_centerPhotoWidth" options:[NSDictionary dictionaryWithObject:LSTRING(@"unchanged") forKey:@"NSNullPlaceholder"]];
			[_galleryImageWidthField bind:@"value" toObject:self withKeyPath:@"_galleryImageWidth" options:[NSDictionary dictionaryWithObject:LSTRING(@"unchanged") forKey:@"NSNullPlaceholder"]];
			[_galleryImageHeightField bind:@"value" toObject:self withKeyPath:@"_galleryImageHeight" options:[NSDictionary dictionaryWithObject:LSTRING(@"unchanged") forKey:@"NSNullPlaceholder"]];
		}
		
		_filenameAlert = [[NSAlert alloc] init];
		[_filenameAlert setMessageText:LSTRING(@"FilenameAlertText")];
		[_filenameAlert addButtonWithTitle:LSTRING(@"AlertOKButton")];		
	}

	return self;
}

- (void)dealloc
{
	[_leftPhotoWidth release];
	[_rightPhotoWidth release];
	[_leftPhotoPadding release];
	[_rightPhotoPadding release];
	[_centerPhotoWidth release];
	[_centerPhotoPadding release];
	[_blockPadding release];
	
	// top level nib objects
	[_editorView release];
	[[_helpWebView window] release];
	
	[_filenameAlert release];
	
	[super dealloc];
}

- (id)initWithCoder:(NSCoder *)aDecoder
{
	
	int version = 0;
	
    if (self = [self init]) {
		if (![aDecoder allowsKeyedCoding]) ODLogError(@"decoder does not support keyed coding");
		
		version = [aDecoder decodeIntForKey:@"version"];
		
		if (version == 1) {
			// user must upgrade webyep-system to 1.2
			NSAlert *alert = nil;
			alert = [NSAlert alertWithMessageText:LSTRING(@"Upgrade1_2WarningTitle") defaultButton:@"OK" alternateButton:nil otherButton:nil informativeTextWithFormat:LSTRING(@"Upgrade1_2WarningMessage")];
			[alert runModal];
		}
		
		if (version < 3 && [NSBundle userPrefersGerman] && lastUpgrade2_3WarningTime < [NSDate timeIntervalSinceReferenceDate] - Upgrade2_3WarningInterval) { // german translation for RW was not available - all german users had english field names!
			NSAlert *alert = nil;
			alert = [NSAlert alertWithMessageText:LSTRING(@"Upgrade2_3WarningTitle") defaultButton:@"OK" alternateButton:nil otherButton:nil informativeTextWithFormat:LSTRING(@"Upgrade2_3WarningMessage")];
			[alert runModal];
			lastUpgrade2_3WarningTime = [NSDate timeIntervalSinceReferenceDate];
		}
		if ([aDecoder containsValueForKey:@"_fieldNameLanguageTag"]) [self setValue:[NSNumber numberWithInt:[aDecoder decodeIntForKey:@"_fieldNameLanguageTag"]] forKey:@"_fieldNameLanguageTag"];
		else [self setValue:[NSNumber numberWithInt:[NSBundle userPrefersGerman] ? FieldNameTagGerman:FieldNameTagEnglish] forKey:@"_fieldNameLanguageTag"];

		// backward compat. to 0.91:
		if ([aDecoder containsValueForKey:@"_logonButtonConfig"]) [self setValue:[NSNumber numberWithInt:[aDecoder decodeIntForKey:@"_logonButtonConfig"]] forKey:@"_logonButtonConfig"];
		else [self setValue:[NSNumber numberWithInt:LogonButtonVisible] forKey:@"_logonButtonConfig"];
		
		[self setValue:[NSNumber numberWithBool:[aDecoder decodeBoolForKey:@"_showPageHeading"]] forKey:@"_showPageHeading"];
		[self setValue:[NSNumber numberWithBool:[aDecoder decodeBoolForKey:@"_showBlockHeading"]] forKey:@"_showBlockHeading"];
		[self setValue:[NSNumber numberWithBool:[aDecoder decodeBoolForKey:@"_showLeftPhoto"]] forKey:@"_showLeftPhoto"];
		[self setValue:[NSNumber numberWithBool:[aDecoder decodeBoolForKey:@"_showRightPhoto"]] forKey:@"_showRightPhoto"];
		
		// backward compat. to 1.1.14:
		if ([aDecoder containsValueForKey:@"_leftPhotoIsThumb"]) [self setValue:[NSNumber numberWithBool:[aDecoder decodeBoolForKey:@"_leftPhotoIsThumb"]] forKey:@"_leftPhotoIsThumb"];
		else {
			[self setValue:[NSNumber numberWithBool:NO] forKey:@"_leftPhotoIsThumb"];
		}
		if ([aDecoder containsValueForKey:@"_rightPhotoIsThumb"]) [self setValue:[NSNumber numberWithBool:[aDecoder decodeBoolForKey:@"_rightPhotoIsThumb"]] forKey:@"_rightPhotoIsThumb"];
		else {
			[self setValue:[NSNumber numberWithBool:NO] forKey:@"_rightPhotoIsThumb"];
		}
		if ([aDecoder containsValueForKey:@"_centerPhotoIsThumb"]) [self setValue:[NSNumber numberWithBool:[aDecoder decodeBoolForKey:@"_centerPhotoIsThumb"]] forKey:@"_centerPhotoIsThumb"];
		else {
			[self setValue:[NSNumber numberWithBool:NO] forKey:@"_centerPhotoIsThumb"];
		}
		
		// backward compat. to 0.9:
		if ([aDecoder containsValueForKey:@"_showText"]) [self setValue:[NSNumber numberWithBool:[aDecoder decodeBoolForKey:@"_showText"]] forKey:@"_showText"];
		else {
			ODLogDebug(@"No _showText value found!");
			[self setValue:[NSNumber numberWithBool:YES] forKey:@"_showText"];
		}
		if ([aDecoder containsValueForKey:@"_doRepeat"]) [self setValue:[NSNumber numberWithBool:[aDecoder decodeBoolForKey:@"_doRepeat"]] forKey:@"_doRepeat"];
		else {
			ODLogDebug(@"No _doRepeat value found!");
			[self setValue:[NSNumber numberWithBool:YES] forKey:@"_doRepeat"];
		}
		
		[self setValue:[NSNumber numberWithBool:[aDecoder decodeBoolForKey:@"_showAttachment"]] forKey:@"_showAttachment"];
		[self setValue:[NSNumber numberWithBool:[aDecoder decodeBoolForKey:@"_showCenterPhoto"]] forKey:@"_showCenterPhoto"];
		
		[self setValue:[NSNumber numberWithInt:[aDecoder decodeIntForKey:@"_pageHeadingLevel"]] forKey:@"_pageHeadingLevel"];
		[self setValue:[NSNumber numberWithInt:[aDecoder decodeIntForKey:@"_blockHeadingLevel"]] forKey:@"_blockHeadingLevel"];
		
		[self setValue:[aDecoder decodeObjectForKey:@"_leftPhotoWidth"] forKey:@"_leftPhotoWidth"];
		[self setValue:[aDecoder decodeObjectForKey:@"_rightPhotoWidth"] forKey:@"_rightPhotoWidth"];
		[self setValue:[aDecoder decodeObjectForKey:@"_leftPhotoPadding"] forKey:@"_leftPhotoPadding"];
		[self setValue:[aDecoder decodeObjectForKey:@"_rightPhotoPadding"] forKey:@"_rightPhotoPadding"];
		[self setValue:[aDecoder decodeObjectForKey:@"_centerPhotoWidth"] forKey:@"_centerPhotoWidth"];
		[self setValue:[aDecoder decodeObjectForKey:@"_centerPhotoPadding"] forKey:@"_centerPhotoPadding"];
		[self setValue:[aDecoder decodeObjectForKey:@"_blockPadding"] forKey:@"_blockPadding"];

		if (version >= 3) {
			[self setValue:[NSNumber numberWithBool:[aDecoder decodeBoolForKey:@"_showGallery"]] forKey:@"_showGallery"];
			[self setValue:[aDecoder decodeObjectForKey:@"_galleryTNWidth"] forKey:@"_galleryTNWidth"];
			[self setValue:[aDecoder decodeObjectForKey:@"_galleryTNHeight"] forKey:@"_galleryTNHeight"];
			[self setValue:[aDecoder decodeObjectForKey:@"_galleryImageWidth"] forKey:@"_galleryImageWidth"];
			[self setValue:[aDecoder decodeObjectForKey:@"_galleryImageHeight"] forKey:@"_galleryImageHeight"];
			[self setValue:[aDecoder decodeObjectForKey:@"_galleryCellWidth"] forKey:@"_galleryCellWidth"];
			[self setValue:[aDecoder decodeObjectForKey:@"_galleryCellCount"] forKey:@"_galleryCellCount"];
			[self setValue:[NSNumber numberWithBool:[aDecoder decodeBoolForKey:@"_showSidebarMenu"]] forKey:@"_showSidebarMenu"];
		}
		
		ODLogDebug(@"version: %d", version);
    }
    return self;
}

//Save Data
- (void)encodeWithCoder:(NSCoder *)aCoder 
{
	if (![aCoder allowsKeyedCoding]) ODLogError(@"decode does not support keyed coding");
	
	[aCoder encodeInt:PluginStructureVersion forKey:@"version"];
	
	[aCoder encodeInt:_fieldNameLanguageTag forKey:@"_fieldNameLanguageTag"];
	[aCoder encodeInt:_logonButtonConfig forKey:@"_logonButtonConfig"];
	[aCoder encodeBool:_showPageHeading forKey:@"_showPageHeading"];
	[aCoder encodeBool:_showBlockHeading forKey:@"_showBlockHeading"];
	[aCoder encodeBool:_showLeftPhoto forKey:@"_showLeftPhoto"];
	[aCoder encodeBool:_leftPhotoIsThumb forKey:@"_leftPhotoIsThumb"];
	[aCoder encodeBool:_showRightPhoto forKey:@"_showRightPhoto"];
	[aCoder encodeBool:_rightPhotoIsThumb forKey:@"_rightPhotoIsThumb"];
	[aCoder encodeBool:_showAttachment forKey:@"_showAttachment"];
	[aCoder encodeBool:_showText forKey:@"_showText"];
	[aCoder encodeBool:_doRepeat forKey:@"_doRepeat"];
	[aCoder encodeBool:_showCenterPhoto forKey:@"_showCenterPhoto"];
	[aCoder encodeBool:_centerPhotoIsThumb forKey:@"_centerPhotoIsThumb"];
	[aCoder encodeInt:_pageHeadingLevel forKey:@"_pageHeadingLevel"];
	[aCoder encodeInt:_blockHeadingLevel forKey:@"_blockHeadingLevel"];
	[aCoder encodeObject:_leftPhotoWidth forKey:@"_leftPhotoWidth"];
	[aCoder encodeObject:_rightPhotoWidth forKey:@"_rightPhotoWidth"];
	[aCoder encodeObject:_leftPhotoPadding forKey:@"_leftPhotoPadding"];
	[aCoder encodeObject:_rightPhotoPadding forKey:@"_rightPhotoPadding"];
	[aCoder encodeObject:_centerPhotoWidth forKey:@"_centerPhotoWidth"];
	[aCoder encodeObject:_centerPhotoPadding forKey:@"_centerPhotoPadding"];
	[aCoder encodeObject:_blockPadding forKey:@"_blockPadding"];
	[aCoder encodeBool:_showGallery forKey:@"_showGallery"];
	[aCoder encodeObject:_galleryTNWidth forKey:@"_galleryTNWidth"];
	[aCoder encodeObject:_galleryTNHeight forKey:@"_galleryTNHeight"];
	[aCoder encodeObject:_galleryImageWidth forKey:@"_galleryImageWidth"];
	[aCoder encodeObject:_galleryImageHeight forKey:@"_galleryImageHeight"];
	[aCoder encodeObject:_galleryCellWidth forKey:@"_galleryCellWidth"];
	[aCoder encodeObject:_galleryCellCount forKey:@"_galleryCellCount"];
	[aCoder encodeBool:_showSidebarMenu forKey:@"_showSidebarMenu"];
}

- (void)observeValueForKeyPath:(NSString *)keyPath ofObject:(id)object change:(NSDictionary *)change context:(void *)context
{
//	NSLog(@"change notification for keyPath %@", keyPath);
	[self broadcastPluginChanged];
}

/*
 - (void)showSetupSheet:(id)sender
 {
 [NSApp beginSheet:_setupPanel modalForWindow:_documentWindow modalDelegate:self didEndSelector:@selector(_didEndSheet:returnCode:contextInfo:) contextInfo:NULL];
 }
 
 - (void)hideSetupSheet:(id)sender
 {
 [NSApp endSheet:_setupPanel];
 }
 
 - (void)_didEndSheet:(NSWindow *)sheet returnCode:(int)returnCode contextInfo:(void *)contextInfo
 {
 [_setupPanel orderOut:self];
 }
 */

- (IBAction)showHelp:(id)sender
{
	NSString *helpFolderPath = [pluginBundle pathForResource:@"Help" ofType:@"" inDirectory:nil forLocalization:[NSBundle userPrefersGerman] ? @"German":@"English"];
	ODLogDebug(@"Help folder: %@", helpFolderPath);
	NSString *indexFilePath = [helpFolderPath stringByAppendingPathComponent:@"index.html"];
	[[_helpWebView mainFrame] loadRequest:[NSURLRequest requestWithURL:[NSURL fileURLWithPath:indexFilePath]]];
	[[_helpWebView window] makeKeyAndOrderFront:sender];
}

- (void)webView:(WebView *)sender decidePolicyForNavigationAction:(NSDictionary *)actionInformation request:(NSURLRequest *)request frame:(WebFrame *)frame decisionListener:(id <WebPolicyDecisionListener>)listener
{
	if ([[actionInformation objectForKey:WebActionNavigationTypeKey] intValue] == WebNavigationTypeLinkClicked) {
		[listener ignore];
		[[NSWorkspace sharedWorkspace] openURL:[request URL]];
	}
	else [listener use];
}

- (void)_showCharEncodingAlert
{
	NSAlert *alert = nil;
	alert = [NSAlert alertWithMessageText:LSTRING(@"UTF8ConfigWarningTitle") defaultButton:@"OK" alternateButton:nil otherButton:nil informativeTextWithFormat:LSTRING(@"UTF8ConfigWarningMessage")];
	[alert runModalWithCheckBoxTitle:LSTRING(@"DontWarnAgain") defaultsKey:DefaultCharsetWarning];
}

// ----------------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------------

//- (void)set_fieldNameLanguageTag:(int)v
//{
//	_fieldNameLanguageTag = v;
//	lastFieldNameLanguageTag = v;
//	[self broadcastPluginChanged];
//}

- (NSString *)_fieldNameLanguage
{
	return _fieldNameLanguageTag == FieldNameTagEnglish ? @"English":@"German";
}

- (NSString *)_urlForResource:(NSString *)basename ofType:(NSString *)ext
{
	NSString *path;
	
	path = [pluginBundle pathForResource:basename ofType:ext];
	if (!path) ODLogError(@"resource  %@ of type %@ not found", basename, ext);
	return [NSString stringWithFormat:@"file://%@", path];
}

- (NSString *)_galleryHTML
{
	NSMutableString *html = [NSMutableString stringWithCapacity:200];
	int cellsPerRow = _galleryCellCount ? [_galleryCellCount intValue]:[DefaultGalleryCellCount intValue];
	int numImages = (int)floor((float)cellsPerRow * 1.5);
	int numCells = (int)(ceil((float)numImages / (float)cellsPerRow) * cellsPerRow);
	int tnWidth = [_galleryTNWidth ? _galleryTNWidth:DefaultGalleryTNWidth intValue];
	int tnAltWidth = (int)floor(tnWidth*0.8);
	int tnHeight = [_galleryTNHeight ? _galleryTNHeight:DefaultGalleryTNHeight intValue];
	int tnAltHeight = (int)floor(tnHeight*0.8);
//	int imageWidth = [_galleryImageWidth ? _galleryImageWidth:@"0" intValue];
//	int imageHeight = [_galleryImageWidth ? _galleryImageHeight:@"0" intValue];
	int cellWidth = [_galleryCellWidth ? _galleryCellWidth:DefaultGalleryCellWidth intValue];
	NSArray *imageURLs = [NSArray arrayWithObjects:[self _urlForResource:@"example_1" ofType:@"jpg"], [self _urlForResource:@"example_2" ofType:@"jpg"], [self _urlForResource:@"example_3" ofType:@"jpg"], nil];
	int imageURLCount = [imageURLs count];
	int i = 0;

	[html appendString:[NSString stringWithFormat:@"<table class=\"WebYepGalleryContainer\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" summary=\"%@\">\n", LSTRING(@"Image Gallery")]];
	while (i < numCells) {
		if (i % cellsPerRow == 0) [html appendString:[NSString stringWithFormat:@"    <tr%@>\n", i < cellsPerRow ? @" class=\"WebYepGalleryFirstRow\"":@""]];
		[html appendString:[NSString stringWithFormat:@"        <td style=\"width:%dpx\"%@>", cellWidth, i % cellsPerRow == 0 ? @" class=\"WebYepGalleryFirstColumn\"":@""]];
		if (i < numImages) {
			[html appendString:[NSString stringWithFormat:@"<div class=\"WebYepGalleryImage\"><a href=\"javascript:void(0)\"><img src=\"%@\" %@></a></div>", [imageURLs objectAtIndex:i % imageURLCount], i % 2 == 0 ? [NSString stringWithFormat:@"width=%d height=%d", tnWidth, tnAltHeight]:[NSString stringWithFormat:@"width=%d height=%d", tnAltWidth, tnHeight]]];
			[html appendString:[NSString stringWithFormat:@"<div class=\"WebYepGalleryText\">%@</div>", [[@"Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed" substringToIndex:(int)(((float)random() / (float)0x7fffffff)*40+10)] stringByAppendingString:@"..."]]];
		}
		[html appendString:@"</td>\n"];
		i++;
		if (i % cellsPerRow == 0) [html appendString:@"    </tr>\n"];
	}
	[html appendString:@"</table>\n"];
	return html;
}

- (NSString *)_contentFragmentNamed:(NSString *)name forDisplayMode:(NSString *)mode
{
	BOOL isPreview = NO;
	NSString *ext = nil;
	NSString *path = nil;
	NSMutableString *content = nil;
	
	if ([mode isEqualToString:RWPluginParamDisplayModePreview]) isPreview = YES;
	if (isPreview && [name isEqualToString:ContentFragmentGallery]) content = [NSMutableString stringWithString:[self _galleryHTML]];
	else {
		if (isPreview) ext = @"html";
		else ext = @"php";
		path = [pluginBundle pathForResource:name ofType:ext inDirectory:@"html_php_framents" forLocalization:[self _fieldNameLanguage]];
		if (!path) ODLogError(@"path for content fragment %@ not found (preview: %d)", name, isPreview);
		else content = [NSMutableString stringWithString:[NSString stringWithContentsOfFile:path]];
	}
	
	[content replaceOccurrencesOfString:@"##PageHeadingLevel##" withString:[NSString stringWithFormat:@"%d", _pageHeadingLevel] options:0 range:NSMakeRange(0, [content length])];
	
	[content replaceOccurrencesOfString:@"##BlockHeadingLevel##" withString:[NSString stringWithFormat:@"%d", _blockHeadingLevel] options:0 range:NSMakeRange(0, [content length])];
	
	[content replaceOccurrencesOfString:@"##LeftPhotoPadding##" withString:_leftPhotoPadding ? _leftPhotoPadding:DefaultFloatingPhotoPadding options:0 range:NSMakeRange(0, [content length])];
	[content replaceOccurrencesOfString:@"##LeftPhotoIsThumb##" withString:_leftPhotoIsThumb ? @"true":@"false" options:0 range:NSMakeRange(0, [content length])];
	[content replaceOccurrencesOfString:@"##LeftPhotoWidth##" withString:_leftPhotoWidth ? _leftPhotoWidth :DefaultFloatingPhotoWidth options:0 range:NSMakeRange(0, [content length])];
	[content replaceOccurrencesOfString:@"##UseLeftPhotoWidth##" withString:_leftPhotoWidth ? @"true":@"false" options:0 range:NSMakeRange(0, [content length])];
	
	
	[content replaceOccurrencesOfString:@"##RightPhotoPadding##" withString:_rightPhotoPadding ? _rightPhotoPadding:DefaultFloatingPhotoPadding options:0 range:NSMakeRange(0, [content length])];
	[content replaceOccurrencesOfString:@"##RightPhotoIsThumb##" withString:_rightPhotoIsThumb ? @"true":@"false" options:0 range:NSMakeRange(0, [content length])];
	[content replaceOccurrencesOfString:@"##RightPhotoWidth##" withString:_rightPhotoWidth ? _rightPhotoWidth:DefaultFloatingPhotoWidth options:0 range:NSMakeRange(0, [content length])];
	[content replaceOccurrencesOfString:@"##UseRightPhotoWidth##" withString:_rightPhotoWidth ? @"true":@"false" options:0 range:NSMakeRange(0, [content length])];
	
	
	[content replaceOccurrencesOfString:@"##CenterPhotoPadding##" withString:_centerPhotoPadding ? _centerPhotoPadding:DefaultCenterPhotoPadding options:0 range:NSMakeRange(0, [content length])];
	[content replaceOccurrencesOfString:@"##CenterPhotoIsThumb##" withString:_centerPhotoIsThumb ? @"true":@"false" options:0 range:NSMakeRange(0, [content length])];
	[content replaceOccurrencesOfString:@"##CenterPhotoWidth##" withString:_centerPhotoWidth ? _centerPhotoWidth:DefaultCenterPhotoWidth options:0 range:NSMakeRange(0, [content length])];
	[content replaceOccurrencesOfString:@"##UseCenterPhotoWidth##" withString:_centerPhotoWidth ? @"true":@"false" options:0 range:NSMakeRange(0, [content length])];
	
	[content replaceOccurrencesOfString:@"##ExamplePhoto1URL##" withString:[self _urlForResource:@"example_1" ofType:@"jpg"] options:0 range:NSMakeRange(0, [content length])];
	[content replaceOccurrencesOfString:@"##ExamplePhoto2URL##" withString:[self _urlForResource:@"example_2" ofType:@"jpg"] options:0 range:NSMakeRange(0, [content length])];
	[content replaceOccurrencesOfString:@"##ExamplePhoto3URL##" withString:[self _urlForResource:@"example_3" ofType:@"jpg"] options:0 range:NSMakeRange(0, [content length])];
	
	[content replaceOccurrencesOfString:@"##BlockPadding##" withString:_blockPadding ? _blockPadding:DefaultBlockPadding options:0 range:NSMakeRange(0, [content length])];
	
	int galleryCellCount = _galleryCellCount ? [_galleryCellCount intValue]:[DefaultGalleryCellCount intValue];
	[content replaceOccurrencesOfString:@"##GalleryNumImages##" withString:[NSString stringWithFormat:@"%d", (int)floor(galleryCellCount * 1.5)] options:0 range:NSMakeRange(0, [content length])];
	[content replaceOccurrencesOfString:@"##GalleryCellsPerRow##" withString:[NSString stringWithFormat:@"%d", galleryCellCount] options:0 range:NSMakeRange(0, [content length])];
	[content replaceOccurrencesOfString:@"##GalleryCellWidth##" withString:_galleryCellWidth ? _galleryCellWidth:DefaultGalleryCellWidth options:0 range:NSMakeRange(0, [content length])];
	[content replaceOccurrencesOfString:@"##GalleryTNWidth##" withString:_galleryTNWidth ? _galleryTNWidth:DefaultGalleryTNWidth options:0 range:NSMakeRange(0, [content length])];
	[content replaceOccurrencesOfString:@"##GalleryTNHeight##" withString:_galleryTNHeight ? _galleryTNHeight:DefaultGalleryTNHeight options:0 range:NSMakeRange(0, [content length])];
	[content replaceOccurrencesOfString:@"##GalleryImageWidth##" withString:_galleryImageWidth ? _galleryImageWidth:DefaultGalleryImageWidth options:0 range:NSMakeRange(0, [content length])];
	[content replaceOccurrencesOfString:@"##GalleryImageHeight##" withString:_galleryImageHeight ? _galleryImageHeight:DefaultGalleryImageHeight options:0 range:NSMakeRange(0, [content length])];

	return content;
}

- (id)_pageFromPageID:(NSString*)pageID
{
	NSObject* document = [[self documentWindow] delegate];
	return [document performSelector:@selector(pageFromUniqueID:) withObject:pageID];
}

- (NSString *)_getInitCode
{
	return [self _contentFragmentNamed:ContentFragmentInitCode forDisplayMode:RWPluginParamDisplayModeExport];
}

- (NSString *)_defaultCustomCSS
{
	NSString *path = [pluginBundle pathForResource:@"default" ofType:@"css" inDirectory:nil forLocalization:[self _fieldNameLanguage]];

	return [NSString stringWithContentsOfFile:path];
}

- (NSString *)_contentHTMLForDisplayMode:(NSString *)mode
{
	BOOL isPreview = NO, usesFloats = _showLeftPhoto || _showRightPhoto;
	int i, count;
	NSMutableString *content = [NSMutableString string];
	
	// debugging:
	[content appendString:[NSString stringWithFormat:@"<!-- Mode: %@ -->\n", mode]];
	
	if ([mode isEqualToString:RWPluginParamDisplayModePreview]) isPreview = YES;
	
	[content appendString:[self _contentFragmentNamed:ContentFragmentFunctions forDisplayMode:mode]];
	
	if (_showPageHeading) [content appendString:[self _contentFragmentNamed:ContentFragmentPageHeading forDisplayMode:mode]];
	count = isPreview && _doRepeat ? 2:1;
	for (i = 0; i < count; i++) {
		if (_doRepeat) [content appendString:[self _contentFragmentNamed:ContentFragmentLoopStart forDisplayMode:mode]];
		if (usesFloats) [content appendString:[self _contentFragmentNamed:ContentFragmentFloatContainerStart forDisplayMode:mode]];
		if (_showBlockHeading) [content appendString:[self _contentFragmentNamed:ContentFragmentBlockHeading forDisplayMode:mode]];
		if (_showLeftPhoto) [content appendString:[self _contentFragmentNamed:ContentFragmentLeftPhoto forDisplayMode:mode]];
		if (_showRightPhoto) [content appendString:[self _contentFragmentNamed:ContentFragmentRightPhoto forDisplayMode:mode]];
		if (_showText) [content appendString:[self _contentFragmentNamed:ContentFragmentText forDisplayMode:mode]];
		if (usesFloats) [content appendString:[self _contentFragmentNamed:ContentFragmentFloatContainerEnd forDisplayMode:mode]];
		if (_showGallery) [content appendString:[self _contentFragmentNamed:ContentFragmentGallery forDisplayMode:mode]];
		if (_showAttachment) [content appendString:[self _contentFragmentNamed:ContentFragmentAttachment forDisplayMode:mode]];
		if (_showCenterPhoto) [content appendString:[self _contentFragmentNamed:ContentFragmentCenterPhoto forDisplayMode:mode]];
		if (_doRepeat) {
			[content appendString:[self _contentFragmentNamed:ContentFragmentBlockPadding forDisplayMode:mode]];
			[content appendString:[self _contentFragmentNamed:ContentFragmentLoopEnd forDisplayMode:mode]];
		}
	}
	
	if (_logonButtonConfig != LogonButtonOff) {
		if (isPreview) {
			[content appendString:[NSString stringWithFormat:@"<div><a href=\"javascript:void(0)\" title=\"%@\"><img alt=\"%@\" src=\"%@\" border=\"0\" /></a></div>", LSTRING(@"LogonButtonHover"), LSTRING(@"LogonButtonHover"), [self _urlForResource:(_logonButtonConfig == LogonButtonVisible ? @"logon-button":@"nix") ofType:@"gif"]]];
		}
		else {
			[content appendString:[NSString stringWithFormat:@"<div><?php webyep_logonButton(%@); ?></div>", _logonButtonConfig == LogonButtonVisible ? @"true":@"false"]];
		}
	}
	
	if (ODDebug) [content writeToFile:@"/tmp/WebYep_RapidWeaver.log" atomically:true];
	
	return content;
}

// ----------------------------------------------------------------------------------------

- (NSString*)overrideFileExtension
{
	return @"php";
}

- (id)contentHTML:(NSDictionary*)params
{
	BOOL isPreview = NO;
	NSString *mode;
	
	ODLogDebug(@"contentHTML: with params: %@", params);
	mode = [params objectForKey:RWPluginParamDisplayMode];
	if ([mode isEqualToString:RWPluginParamDisplayModePreview]) isPreview = YES;


	id page = [self _pageFromPageID:[self uniqueID]];
	if (page) {
		NSString *customCSS = [page valueForKeyPath:@"styles.customCSS"];
		if (customCSS && [customCSS length] != 0) {
			// In older versions of the plugin, german CSS class names where used.
			// If the CSS code contains those old german class names, replace them with the now used english ones:
			NSDictionary *cssReplacementPairs = [NSDictionary dictionaryWithObjectsAndKeys:
					@"WebYepPageHeading", @"WebYepSeitenTitel",
					@"WebYepBlockHeading", @"WebYepBlockTitel",
					@"WebYepBlockPadding", @"WebYepBlockAbstand",
					@"WebYepLeftPhoto", @"WebYepFotoLinks",
					@"WebYepRightPhoto", @"WebYepFotoRechts",
					@"WebYepCenterPhoto", @"WebYepFotoZentriert",
					@"WebYepAttachment", @"WebYepDateianhang",
					@"WebYepAttachmentDescription", @"WebYepDateianhangBeschreibung",
					@"WebYepAttachmentFilename", @"WebYepDateianhangDateiname",
					nil
				];
			int numRep = 0;
			NSString *correctedCSS = [customCSS stringByReplacingOccurencesOfPairs:cssReplacementPairs numberOfReplacements:&numRep];
			if (numRep > 0) {
				[page setValue:correctedCSS forKeyPath:@"styles.customCSS"];
//				[self performSelector:@selector(broadcastPluginChanged) withObject:nil afterDelay:0.0];
				[self performSelectorOnMainThread:@selector(broadcastPluginChanged) withObject:nil waitUntilDone:NO];
			}
		}
	}


	{
		id <RWPageAttributes> atts = [params objectForKey:@"attributes"];
		if (atts) {

//			id page = [self pageFromPageID:[self uniqueID]];
			/* id page = [atts valueForKey:@"_page"]; */
//			NSString *customCSS = [page valueForKeyPath:@"styles.customCSS"];
//			if (!customCSS || [customCSS length] == 0) [page setValue:[self _defaultCustomCSS] forKeyPath:@"styles.customCSS"];

//			NSString *initCode = [self _getInitCode];
//			if (![[atts pagePrefix] isEqualToString:initCode]) [atts setPagePrefix:[self _getInitCode]];

			if (!isPreview && ![[atts encoding] isEqualToString:@"Unicode (UTF-8)"]) {
				[self performSelectorOnMainThread:@selector(_showCharEncodingAlert) withObject:nil waitUntilDone:NO];
			}
		}
		else ODLogError(@"no page attributes object");
	}
	
	return [self _contentHTMLForDisplayMode:mode];
}

- (NSString *)sidebarHTML:(NSDictionary*)params
{
	NSString *mode;
	mode = [params objectForKey:RWPluginParamDisplayMode];
	if (_showSidebarMenu) return [self _contentFragmentNamed:ContentFragmentSidebarMenu forDisplayMode:mode];
	else return nil;
}

- (NSArray *)extraFilesNeededInExportFolder:(NSDictionary*)params
{
	return nil;
}

+ (NSArray *)extraFilesNeededInExportFolder:(NSDictionary*)params
{
	return nil;
}

// ----------------------------------------------------------------------------------------

+ (BOOL)initializeClass:(NSBundle *)theBundle
{
	ODDebug = NO;
	
	if (!pluginBundle){
		pluginBundle = [theBundle retain];
	}
	return (pluginBundle != nil);
}

+ (NSEnumerator *)pluginsAvailable;
{
	WebYepPlugin *plugin;
	
	if ((plugin = [[WebYepPlugin alloc] init]) != nil){
		// return [[NSArray arrayWithObject:[plugin autorelease]] objectEnumerator];
		// who retains the array????
		return [[NSArray arrayWithObject:plugin] objectEnumerator];
	}
	return nil;
}

+ (NSString *)pluginName
{
	return LSTRING(@"PluginName");
}

+ (NSString *)pluginAuthor
{ 
	return @"obdev.at";
}

+ (NSImage *)pluginIcon
{
	NSDictionary *info = [[NSBundle mainBundle] infoDictionary];
	NSString *version = [info objectForKey:@"CFBundleShortVersionString"];
	if (version && [version doubleValue] >= 4.0 && [version intValue] < 10)	return [[[NSImage alloc] initWithContentsOfFile:[[NSBundle bundleForClass:[self class]] pathForImageResource:@"WebYep_Large"]] autorelease];
	else return [[[NSImage alloc] initWithContentsOfFile:[[NSBundle bundleForClass:[self class]] pathForImageResource:@"plugin_icon"]] autorelease]; 
}

+ (BOOL)hasHTMLDescription
{
	return YES;
}

+ (NSString *)pluginDescription;
{	
	return LSTRING(@"PluginDescription");
}

- (NSView *)userInteractionAndEditingView
{
	if (!_setupDone) {
		id page = [self _pageFromPageID:[self uniqueID]];
		// id page = [atts valueForKey:@"_page"];
		
		if (page) {
			NSString *customCSS = [page valueForKeyPath:@"styles.customCSS"];
			NSString *initCode = [page valueForKeyPath:@"attributes.pagePrefix"];
			if (!customCSS || [customCSS length] == 0) {
				[page setValue:[self _defaultCustomCSS] forKeyPath:@"styles.customCSS"];
				NSAlert *alert = nil;
				alert = [NSAlert alertWithMessageText:LSTRING(@"CSSInfoTitle") defaultButton:@"OK" alternateButton:nil otherButton:nil informativeTextWithFormat:LSTRING(@"CSSInfoMessage")];
				[alert runModalWithCheckBoxTitle:LSTRING(@"DontInfoAgain") defaultsKey:CSSInfo];
			}
//			else {
//				In older versions of the plugin, german CSS class names where used.
//				If the CSS code contains those old german class names, replace them with the now used english ones:
//				NSDictionary *cssReplacementPairs = [NSDictionary dictionaryWithObjectsAndKeys:
//						@"WebYepPageHeading", @"WebYepSeitenTitel",
//						@"WebYepBlockHeading", @"WebYepBlockTitel",
//						@"WebYepBlockPadding", @"WebYepBlockAbstand",
//						@"WebYepLeftPhoto", @"WebYepFotoLinks",
//						@"WebYepRightPhoto", @"WebYepFotoRechts",
//						@"WebYepCenterPhoto", @"WebYepFotoZentriert",
//						@"WebYepAttachment", @"WebYepDateianhang",
//						@"WebYepAttachmentDescription", @"WebYepDateianhangBeschreibung",
//						@"WebYepAttachmentFilename", @"WebYepDateianhangDateiname",
//						nil
//					];
//				int numRep = 0;
//				NSString *correctedCSS = [customCSS stringByReplacingOccurencesOfPairs:cssReplacementPairs numberOfReplacements:&numRep];
//				if (numRep > 0) {
//					[page setValue:correctedCSS forKeyPath:@"styles.customCSS"];
//					[self performSelector:@selector(broadcastPluginChanged) withObject:nil afterDelay:0.0];
//				}
//			}
			if (!initCode || [initCode length] == 0) [page setValue:[self _getInitCode] forKeyPath:@"attributes.pagePrefix"];
		}
		_setupDone = YES;
	}

	return _editorView; 
}

@end
