
// WYLocalizedBundle.h
// Project: ODAppKit
//
// Created by Norbert Heger on 2006/06/09.
// Copyright (c) 2006 Objective Development. All rights reserved.

#import <Cocoa/Cocoa.h>

@interface NSBundle (WYLocalizedBundle)

+ (BOOL)wy_loadLocalizedNibFile:(NSString *)fileName externalNameTable:(NSDictionary *)context withZone:(NSZone *)zone;
+ (BOOL)wy_loadLocalizedNibNamed:(NSString *)nibName owner:(id)owner;

// - (BOOL)wy_loadLocalizedNibFile:(NSString *)fileName externalNameTable:(NSDictionary *)context withZone:(NSZone *)zone;
// ### not yet implemented

+ (NSBundle *)wy_bundleForNibPath:(NSString *)path;
	// Returns the bundle containing the specified nib file.
	// If no bundle could be found, [NSBundle mainBundle] will be returned instead.

@end


@interface WYLocalizedBundle : NSBundle
{
}

@end

/* WYLocalizedBundle can be used as a posing replacement for NSBundle.
The subclass overrides +loadNibFile:externalNameTable:withZone: to invoke
+wy_loadLocalizedNibFile:externalNameTable:withZone: instead. As a consequence,
every loaded nib file will be automatically localized.

Posing should be performed as early as possible, preferably in +[NSApplication initialize]

+ (void)initialize
{
	[[WYLocalizedBundle class] poseAsClass:[NSBundle class]];
}
*/
