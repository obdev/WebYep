//
//  od_foundation.c
//  NX5
//
//  Created by Johannes Tiefenbrunner on 12.08.2005.
//  Copyright 2005 Objective Development GmbH. All rights reserved.
//
// Revision: $Id$

#import <Foundation/foundation.h>

BOOL ODDebug;

void _ODLogDebug(NSString *txt, const char *file, unsigned int line)
{
    if (ODDebug) NSLog([NSString stringWithFormat:@"%s,%d: %@", file, line, txt]);
}

void _ODLogError(NSString *txt, const char *file, unsigned int line)
{
    NSLog([NSString stringWithFormat:@"Error: %s,%d: %@", file, line, txt]);
}

void _ODLogArray(NSArray *a, SEL s)
{
   NSMutableString *log = [NSMutableString string];
   NSEnumerator *enumerator = [a objectEnumerator];
   id object, value;
   BOOL sep = NO;

   if (!ODDebug) return;

   [log appendString:@"("];

   while (object = [enumerator nextObject]) {
   	value = [object performSelector:s];
      [log appendString:[NSString stringWithFormat:@"%s%@", sep ? ", ":"", value]];
      sep = YES;
   }
   
   [log appendString:@")"];
   NSLog(log);
}

void _ODLogDebugArray(NSArray *a, SEL s, const char *file, unsigned int line)
{
   if (ODDebug) {
      NSLog([NSString stringWithFormat:@"Array in: %s,%d:", file, line]);
      _ODLogArray(a, s);
   }
}
