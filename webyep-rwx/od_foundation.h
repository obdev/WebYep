//
//  od_foundation.h
//  NX5
//
//  Created by Johannes Tiefenbrunner on 12.08.2005.
//  Copyright 2005 Objective Development GmbH. All rights reserved.
//
// Revision: $Id$

#ifdef ODDEBUG
   #define ODLogDebug(txt, ...) _ODLogDebug([NSString stringWithFormat:txt, ## __VA_ARGS__], __FILE__, __LINE__)
   #define ODLogDebugArray(a, s) _ODLogDebugArray(a, s, __FILE__, __LINE__)
#else
   #define ODLogDebug(txt, ...)
   #define ODLogDebugArray(a, s)
#endif

#define ODLogError(txt, ...) _ODLogError([NSString stringWithFormat:txt, ## __VA_ARGS__], __FILE__, __LINE__)

extern BOOL ODDebug;
void _ODLogDebug(NSString *txt, const char *file, unsigned int line);
void _ODLogError(NSString *txt, const char *file, unsigned int line);
void _ODLogArray(NSArray *a, SEL s);
void _ODLogDebugArray(NSArray *a, SEL s, const char *file, unsigned int line);
