//
//  WYNSBundleAdditions.h
//  WebYep
//
//  Created by Johannes Tiefenbrunner on 14.08.2008.
//  Copyright 2008 Objective Developement Software GmbH. All rights reserved.
//

#import <Cocoa/Cocoa.h>

@interface NSBundle (WYNSBundleAdditions)

- (NSString *)localizedStringForKey:(NSString *)key value:(NSString *)value table:(NSString *)tableName overrideLanguagePrefs:(BOOL)override;
+ (BOOL)userPrefersGerman;
//+ (BOOL)userPrefersEnglish;

@end
