//
//  WYNSBundleAdditions.m
//  WebYep
//
//  Created by Johannes Tiefenbrunner on 14.08.2008.
//  Copyright 2008 Objective Developement Software GmbH. All rights reserved.
//

#import "WYNSBundleAdditions.h"

static NSMutableDictionary *tables = nil;

@implementation NSBundle (WYNSBundleAdditions)

- (NSDictionary *)tableForPath:(NSString *)path
{
	if (!tables) tables = [[NSMutableDictionary alloc] init];
	return [tables objectForKey:path];
}

- (void)setTable:(NSDictionary *)table forPath:(NSString *)path
{
	if (!tables) tables = [[NSMutableDictionary alloc] init];
	[tables setObject:table forKey:path];
}

- (NSString *)localizedStringForKey:(NSString *)key value:(NSString *)value table:(NSString *)tableName overrideLanguagePrefs:(BOOL)override
{
	if (override) {
		NSString *localizedString = nil;
		if (!tableName) tableName = @"Localizable";
		NSString *tableFilePath = [[[self resourcePath] stringByAppendingPathComponent:[[self class] userPrefersGerman] ? @"German.lproj":@"English.lproj"] stringByAppendingPathComponent:[NSString stringWithFormat:@"%@.strings", tableName]];
		NSDictionary *table = [self tableForPath:tableFilePath];
		if (!table) {
			NSString *contents = [NSString stringWithContentsOfFile:tableFilePath];
			table = [contents propertyListFromStringsFileFormat];
			[self setTable:table forPath:tableFilePath];
		}
		localizedString = [table objectForKey:key];
		if (!localizedString) localizedString = key;
		return localizedString;
	}
	else {
		return [self localizedStringForKey:(NSString *)key value:(NSString *)value table:(NSString *)tableName];
	}
}

+ (BOOL)userPrefersGerman
{
	NSString *lang = [[NSBundle preferredLocalizationsFromArray:[NSArray arrayWithObjects:@"English", @"German", nil] forPreferences:nil] objectAtIndex:0];
	return [lang isEqualToString:@"German"] || [lang rangeOfString:@"de"].location == 0;
}

//+ (BOOL)userPrefersEnglish
//{
//	NSString *lang = [[NSBundle preferredLocalizationsFromArray:[NSArray arrayWithObjects:@"English", @"German", nil] forPreferences:nil] objectAtIndex:0];
//	return [lang isEqualToString:@"English"] || [lang rangeOfString:@"en"].location == 0;
//}

@end
