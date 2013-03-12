
// WYLocalization.h
// Project: ODAppKit
//
// Created by Norbert Heger on 2005/11/07.
// Copyright (c) 2005 Objective Development. All rights reserved.

#import <Cocoa/Cocoa.h>

@interface NSObject (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle;
- (void)wy_localizeWithTable:(NSString *)table;
- (void)localize;
@end

@interface NSString (WYLocalization)
- (NSString *)wy_localizedStringFromTable:(NSString *)table inBundle:(NSBundle *)bundle;
- (NSString *)wy_localizedStringFromTable:(NSString *)table;
- (NSString *)wy_localizedString;
@end

NSString *WYLocalizedStringFromTableInBundle(NSString *string, NSString *table, NSBundle *bundle);
NSString *WYLocalizedStringFromTable(NSString *string, NSString *table);
NSString *WYLocalizedString(NSString *string);

extern BOOL WYLocalizeStringForKeyInDictionary(NSMutableDictionary *dictionary, NSString *key, NSString *table, NSBundle *bundle);
	// returns YES if a change was applied to dictionary
