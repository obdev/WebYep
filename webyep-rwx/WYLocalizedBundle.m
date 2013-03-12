
// WYLocalizedBundle.m
// Project: ODAppKit
//
// Created by Norbert Heger on 2006/06/09.
// Copyright (c) 2006 Objective Development. All rights reserved.

#import "WYLocalizedBundle.h"
#import "WYLocalization.h"

@implementation NSBundle (WYLocalizedBundle)

+ (NSBundle *)wy_bundleForNibPath:(NSString *)path
{
	NSBundle *bundle = nil;
	NSRange r = [path rangeOfString:@"/Contents/Resources/" options:NSBackwardsSearch];
	if (r.location != NSNotFound) {
		NSString *bundlePath = [path substringToIndex:r.location];
		bundle = [self bundleWithPath:bundlePath];
	}
	return (bundle != nil) ? bundle : [self mainBundle];
}

+ (BOOL)_wy_loadNibFile:(NSString *)fileName externalNameTable:(NSDictionary *)context withZone:(NSZone *)zone
{
	return [self loadNibFile:fileName externalNameTable:context withZone:zone];
}

+ (BOOL)wy_loadLocalizedNibFile:(NSString *)fileName externalNameTable:(NSDictionary *)context withZone:(NSZone *)zone
{
	NSArray *topLevelObjects = [context objectForKey:@"NSTopLevelObjects"];
	if (topLevelObjects == nil) {
		topLevelObjects = [NSMutableArray array];
		context = [NSMutableDictionary dictionaryWithDictionary:context];
		[(NSMutableDictionary *)context setObject:topLevelObjects forKey:@"NSTopLevelObjects"];
	}

	BOOL result = [self _wy_loadNibFile:fileName externalNameTable:context withZone:zone];

	NSString *table = [[fileName lastPathComponent] stringByDeletingPathExtension];
	NSBundle *bundle = [self wy_bundleForNibPath:fileName];
	unsigned int i, count = [topLevelObjects count];
	for (i = 0; i < count; i++) {
		[[topLevelObjects objectAtIndex:i] wy_localizeWithTable:table inBundle:bundle];
	}

	return result;
}

+ (BOOL)wy_loadLocalizedNibNamed:(NSString *)nibName owner:(id)owner
{
	NSBundle *bundle = nil;
	NSZone *zone = NULL;
	NSDictionary *context = nil;

	if (owner != nil) {
		bundle = [NSBundle bundleForClass:[owner class]];
		zone = [owner zone];
		context = [NSDictionary dictionaryWithObject:owner forKey:@"NSOwner"];
	}
	if (bundle == nil) { bundle = [NSBundle mainBundle]; }
	if ([nibName hasSuffix:@".nib"]) { nibName = [nibName stringByDeletingPathExtension]; }
	NSString *nibPath = [bundle pathForResource:nibName ofType:@"nib"];
	return [self wy_loadLocalizedNibFile:nibPath externalNameTable:context withZone:zone];
}

@end

@implementation WYLocalizedBundle

+ (BOOL)_wy_loadNibFile:(NSString *)fileName externalNameTable:(NSDictionary *)context withZone:(NSZone *)zone
{
	return [super loadNibFile:fileName externalNameTable:context withZone:zone];
}

+ (BOOL)loadNibFile:(NSString *)fileName externalNameTable:(NSDictionary *)context withZone:(NSZone *)zone
{
	return [self wy_loadLocalizedNibFile:fileName externalNameTable:context withZone:zone];
}

@end
