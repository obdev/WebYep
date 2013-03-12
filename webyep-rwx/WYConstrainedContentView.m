//
//  WYConstrainedContentView.m
//  WebYep
//
//  Created by Johannes Tiefenbrunner on 27.09.2006.
//  Copyright 2006 Objective Development Software GmbH. All rights reserved.
//
// Revision: $Id$

#import "WYConstrainedContentView.h"

#define MIN_WIDTH 515
#define MIN_HEIGHT 697

@implementation WYConstrainedContentView

- (void)setFrame:(NSRect)frameRect
{
   NSView *parent = [self superview];
   NSRect clipViewFrame = [parent frame];

   if (clipViewFrame.size.width <= MIN_WIDTH) frameRect.size.width = MIN_WIDTH;
   else frameRect.size.width = clipViewFrame.size.width;
   if (clipViewFrame.size.height <= MIN_HEIGHT) frameRect.size.height = MIN_HEIGHT;
   else frameRect.size.height = clipViewFrame.size.height;
   [super setFrame:frameRect];
}

//- (void)setFrameSize:(NSSize)newSize
//{
//   [super setFrameSize:newSize];
//   NSLog(@"setFrameSize: called");
//}
//
//- (void)setBounds:(NSRect)boundsRect
//{
//   [super setBounds:boundsRect];
//   NSLog(@"setBounds: called");
//}
//
//- (void)setBoundsSize:(NSSize)newSize
//{
//   [super setBoundsSize:newSize];
//   NSLog(@"setBoundsSize: called");
//}

@end
