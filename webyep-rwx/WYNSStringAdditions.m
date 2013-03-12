//
//  WYNSStringAdditions.m
//  WebYep
//
//  Created by Johannes Tiefenbrunner on 01.04.2009.
//  Copyright 2009 Objective Developement Software GmbH. All rights reserved.
//

#import "WYNSStringAdditions.h"

@implementation NSString (WYNSStringAdditions)

- (NSString *)stringByReplacingOccurencesOfPairs:(NSDictionary *)cssReplacementPairs numberOfReplacements:(int *)numRep {

	NSMutableString *newString = [NSMutableString stringWithString:self];

	if (numRep != NULL) *numRep = 0;
	NSEnumerator *pairEnum = [cssReplacementPairs keyEnumerator];
	NSString *aKey;
	while ((aKey = [pairEnum nextObject]) != nil) {
		NSString *aValue = [cssReplacementPairs objectForKey:aKey];
		int count = [newString replaceOccurrencesOfString:aKey withString:aValue options:NSCaseInsensitiveSearch range:NSMakeRange(0, [newString length])];
		if (count > 0 && numRep != NULL) *numRep += count;
	}

	return newString;
}

@end
