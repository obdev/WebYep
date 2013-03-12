//
//  WebYepPlugin.h
//  WebYep
//
//  Created by Johannes Tiefenbrunner on 21.09.2006.
//  Copyright 2006 Objective Development Software GmbH. All rights reserved.
//
// Revision: $Id$

#import <Cocoa/Cocoa.h>
#import <WebKit/WebKit.h>
#import <RWPluginUtilities/RWPluginUtilities.h>
#import "od_foundation.h"

@interface WebYepPlugin : RWAbstractPlugin {
	IBOutlet NSView *_editorView;
	IBOutlet WebView *_helpWebView;
	IBOutlet NSTextField *_leftWidthField;
	IBOutlet NSTextField *_rightWidthField;
	IBOutlet NSTextField *_centerWidthField;
	IBOutlet NSTextField *_galleryImageWidthField;
	IBOutlet NSTextField *_galleryImageHeightField;
	BOOL _setupDone;
	int _fieldNameLanguageTag;
	BOOL _showPageHeading;
	BOOL _showBlockHeading;
	BOOL _showLeftPhoto;
	BOOL _leftPhotoIsThumb;
	BOOL _showRightPhoto;
	BOOL _rightPhotoIsThumb;
	BOOL _showText;
	BOOL _doRepeat;
	BOOL _showAttachment;
	BOOL _showCenterPhoto;
	BOOL _centerPhotoIsThumb;
	BOOL _showGallery;
	BOOL _showSidebarMenu;
	int _blockHeadingLevel;
	int _pageHeadingLevel;
	int _logonButtonConfig;
	NSString *_leftPhotoWidth;
	NSString *_rightPhotoWidth;
	NSString *_leftPhotoPadding;
	NSString *_rightPhotoPadding;
	NSString *_centerPhotoWidth;
	NSString *_centerPhotoPadding;
	NSString *_blockPadding;
	NSString *_galleryTNWidth;
	NSString *_galleryTNHeight;
	NSString *_galleryImageWidth;
	NSString *_galleryImageHeight;
	NSString *_galleryCellWidth;
	NSString *_galleryCellCount;
	
	// PHP code should be "tidy"able now
	// NSAlert *_outputModeAlert;
	NSAlert *_filenameAlert;
}

- (IBAction)showHelp:(id)sender;

@end

@protocol RWPageAttributes

- (NSString *)pagePrefix;
- (void)setPagePrefix:(NSString *)aPrefix;

- (NSString *)output;
- (NSString *)encoding;
- (NSString *)filenameExt;
- (NSString *)overrideFilenameExt;
- (id)pageAttributes;

- (id)headers;
- (id)headersText;

- (id)_page;

@end

@protocol RWDocument
- (id)com_rwrp_currentlySelectedPage;
@end

@protocol RWPage
- (id)attributes;
@end

