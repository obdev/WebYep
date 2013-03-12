//
//  WYNSStringAdditions.h
//  WebYep
//
//  Created by Johannes Tiefenbrunner on 01.04.2009.
//  Copyright 2009 Objective Developement Software GmbH. All rights reserved.
//

#import <Cocoa/Cocoa.h>

@interface NSString (WYNSStringAdditions)

- (NSString *)stringByReplacingOccurencesOfPairs:(NSDictionary *)cssReplacementPairs numberOfReplacements:(int *)numRep;

@end
