//
//  GDNSAlertPanelAdditions.m
//  NSAlertPanelAdditionsTest
//
//  Created by Johannes Tiefenbrunner on 01.11.2006.
//  Copyright 2006 Objective Development Software GmbH. All rights reserved.
//

#import "WYNSAlertAdditions.h"

@implementation NSAlert (GDNSAlertPanelAdditions)

- (int)runModalWithCheckBoxTitle:(NSString *)cbTitle defaultsKey:(NSString *)key
{
   int returnValue = NSAlertDefaultReturn;
	NSString *defaultsValue = nil;

   defaultsValue = [[NSUserDefaults standardUserDefaults] stringForKey:key];
   if (!defaultsValue) {
      NSButton *checkbox = nil;
      checkbox = [self addButtonWithTitle:cbTitle];
      [checkbox setButtonType:NSSwitchButton];
      [checkbox setTarget:nil];
      [checkbox setAction:NULL];
      returnValue = [self runModal];
      if ([checkbox state]) {
	      [[NSUserDefaults standardUserDefaults] setObject:[NSString stringWithFormat:@"%d", returnValue] forKey:key];
      }
   }
   else returnValue = [defaultsValue intValue];
   return returnValue;
}

@end
