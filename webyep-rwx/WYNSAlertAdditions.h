//
//  GDNSAlertPanelAdditions.h
//  NSAlertPanelAdditionsTest
//
//  Created by Johannes Tiefenbrunner on 01.11.2006.
//  Copyright 2006 Objective Development Software GmbH. All rights reserved.
//

#import <Cocoa/Cocoa.h>

@interface NSAlert (GDNSAlertPanelAdditions)

- (int)runModalWithCheckBoxTitle:(NSString *)cbTitle defaultsKey:(NSString *)key;

@end
