
// WYLocalization.m
// Project: ODAppKit
//
// Created by Norbert Heger on 2005/11/07.
// Copyright (c) 2005 Objective Development. All rights reserved.

#import "WYLocalization.h"
#import "WYNSBundleAdditions.h"

NSString *WYLocalizedStringFromTableInBundle(NSString *string, NSString *table, NSBundle *bundle)
{
	if (bundle == nil) {
		static NSBundle *mainBundle = nil; // cache the mainBundle
		if (mainBundle == nil) {
			mainBundle = [[NSBundle mainBundle] retain];
		}
		bundle = mainBundle;
	}
	return [bundle localizedStringForKey:string value:nil table:table overrideLanguagePrefs:YES];
}

NSString *WYLocalizedStringFromTable(NSString *string, NSString *table)
{
	return WYLocalizedStringFromTableInBundle(string, table, nil);
}

NSString *WYLocalizedString(NSString *string)
{
	return WYLocalizedStringFromTableInBundle(string, nil, nil);
}

BOOL WYLocalizeStringForKeyInDictionary(NSMutableDictionary *dictionary, NSString *key, NSString *table, NSBundle *bundle)
{
	id s = [dictionary objectForKey:key];
	if (s != nil && s != [NSNull null]) {
		[dictionary setObject:WYLocalizedStringFromTableInBundle(s, table, bundle) forKey:key];
		return YES;
	}
	return NO;
}

#define WYLocalize(object, readSelector, writeSelector) do { \
	NSString *old = [object readSelector]; \
	if (old != nil && [old length] != 0) { \
		NSString *new = WYLocalizedStringFromTableInBundle(old, table, bundle); \
		if (![new isEqualToString:old]) { [object writeSelector:new]; } \
	} \
} while (0);

// -----------------------------------------------------------------------------
// foundation
// -----------------------------------------------------------------------------

@implementation NSObject (WYLocalization)

- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle
{
	// the default implementation does nothing
}

- (void)wy_localizeWithTable:(NSString *)table
{
	[self wy_localizeWithTable:table inBundle:nil];
}

- (void)localize
{
	[self wy_localizeWithTable:nil];
}

// not supported in 10.3:
/*
- (BOOL)localizeBinding:(NSString *)binding withTable:(NSString *)table inBundle:(NSBundle *)bundle optionKeys:(NSArray *)keys
{
	NSDictionary *info = [self infoForBinding:binding];
	if (info != nil) {
		NSMutableDictionary *options = [[[info objectForKey:NSOptionsKey] mutableCopy] autorelease];
		BOOL didChange = NO;
		NSEnumerator *enumerator = [keys objectEnumerator];
		NSString *key;

		while ((key = [enumerator nextObject]) != nil) {
			didChange |= WYLocalizeStringForKeyInDictionary(options, key, table, bundle);
		}

		if (didChange) {
			// [self unbind:binding];
			// not necessary, even more, causes crash when multiple views
			// are bound to the same controller/keyPath

			[self bind:binding
				toObject:[info objectForKey:NSObservedObjectKey]
				withKeyPath:[info objectForKey:NSObservedKeyPathKey]
				options:options];
		}
		return YES;
	}
	return NO;
}
*/

@end

@implementation NSString (WYLocalization)

- (NSString *)wy_localizedStringFromTable:(NSString *)table inBundle:(NSBundle *)bundle {
	return WYLocalizedStringFromTableInBundle(self, table, bundle);
}
- (NSString *)wy_localizedStringFromTable:(NSString *)table {
	return WYLocalizedStringFromTableInBundle(self, table, nil);
}
- (NSString *)wy_localizedString {
	return WYLocalizedStringFromTableInBundle(self, nil, nil);
}

@end

@implementation NSArray (WYLocalization)

- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle
{
	unsigned int i, count = [self count];
	for (i = 0; i < count; i++) {
		[[self objectAtIndex:i] wy_localizeWithTable:table inBundle:bundle];
	}
}

@end

// -----------------------------------------------------------------------------
// cells
// -----------------------------------------------------------------------------

@implementation NSCell (WYLocalization)

- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle
{
	WYLocalize(self, stringValue, setStringValue);

// not supported in 10.3:
/*
	NSDateFormatter *formatter = (NSDateFormatter *)[self formatter];
	if (formatter != nil && [formatter isKindOfClass:[NSDateFormatter class]]) {
		NSString *old = [formatter dateFormat];
		if (old != nil) {
			NSString *new = [old wy_localizedStringFromTable:table inBundle:bundle];
			if (![new isEqualToString:old]) {
				[formatter setFormatterBehavior:NSDateFormatterBehavior10_4];
				[formatter setDateFormat:new];
				// [formatter setLocale:[NSLocale currentLocale]];
				// Note: date format must be in ICU library format.
				// See: http://icu.sourceforge.net/userguide/formatDateTime.html
			}
		}
	}
*/
}

@end

@implementation NSFormCell (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle {
	[super wy_localizeWithTable:table inBundle:bundle];
	WYLocalize(self, title, setTitle);
}
@end

@implementation NSTextFieldCell (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle {
	[super wy_localizeWithTable:table inBundle:bundle];
	WYLocalize(self, placeholderString, setPlaceholderString);
}
@end

@implementation NSButtonCell (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle {
	[super wy_localizeWithTable:table inBundle:bundle];
	if ([self imagePosition] != NSImageOnly && ![self isKindOfClass:[NSPopUpButtonCell class]]) {
		WYLocalize(self, title, setTitle);
	}
}
@end

@implementation NSPopUpButtonCell (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle {
	[super wy_localizeWithTable:table inBundle:bundle];
	[[self itemArray] wy_localizeWithTable:table inBundle:bundle];
}
@end

@implementation NSSegmentedCell (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle
{
	unsigned int i, count = [self segmentCount];
	for (i = 0; i < count; i++) {
		// [self setLabel:... forSegment:i];
		// [self setToolTip:... forSegment:i];
		[[self menuForSegment:i] wy_localizeWithTable:table inBundle:bundle];
	}
	// ### TODO: @implementation NSSegmentedControl (WYLocalization)
}
@end

// -----------------------------------------------------------------------------
// views
// -----------------------------------------------------------------------------

@implementation NSView (WYLocalization)

- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle
{
	[[self subviews] wy_localizeWithTable:table inBundle:bundle];
	WYLocalize(self, toolTip, setToolTip);
}
@end

@implementation NSBox (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle
{
	[super wy_localizeWithTable:table inBundle:bundle];
	WYLocalize(self, title, setTitle);
}
@end

@implementation NSControl (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle {
	[super wy_localizeWithTable:table inBundle:bundle];
	[[self cell] wy_localizeWithTable:table inBundle:bundle];
}
@end

@implementation NSTextField (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle
{
	[super wy_localizeWithTable:table inBundle:bundle];

// not supported in 10.3:
/*
int i = 1;
	NSArray *localizableOptionKeys = [NSArray arrayWithObjects:
		NSDisplayPatternBindingOption,
		NSMultipleValuesPlaceholderBindingOption,
		NSNoSelectionPlaceholderBindingOption,
		NSNotApplicablePlaceholderBindingOption,
		NSNullPlaceholderBindingOption,
		nil];

	while ([self localizeBinding:[NSString stringWithFormat:@"displayPatternValue%d", i++]
		withTable:table inBundle:bundle optionKeys:localizableOptionKeys]);
*/
}
@end


@implementation NSPopUpButton (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle
{
	[super wy_localizeWithTable:table inBundle:bundle];
// not supported in 10.3:
/*
	[self localizeBinding:@"contentValues" withTable:table inBundle:bundle optionKeys:[NSArray arrayWithObjects:
		NSMultipleValuesPlaceholderBindingOption,
		NSNoSelectionPlaceholderBindingOption,
		NSNotApplicablePlaceholderBindingOption,
		NSNullPlaceholderBindingOption,
		nil]];
*/
}
@end

@implementation NSMatrix (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle
{
	[super wy_localizeWithTable:table inBundle:bundle];
	[[self cells] wy_localizeWithTable:table inBundle:bundle];
	// ### TODO setToolTip:forCell:
}
@end

@implementation NSForm (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle
{
	[super wy_localizeWithTable:table inBundle:bundle];
	[self calcSize]; // updates the cells' title widths
}
@end

@implementation NSBrowser (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle
{
	unsigned int i, count = [self numberOfVisibleColumns];
	for (i = 0; i < count; i++) {
		NSString *old = [self titleOfColumn:i];
		if ([old length]) {
			NSString *new = WYLocalizedStringFromTableInBundle(old, table, bundle);
			if (![new isEqualToString:old]) { [self setTitle:new ofColumn:i]; }
		}
	}
}
@end

@implementation NSComboBox (WYLocalization)

- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle
{
	[super wy_localizeWithTable:table inBundle:bundle];

	if (![self usesDataSource]) {
		unsigned int i, count = [self numberOfItems];
		NSMutableArray *array = [NSMutableArray arrayWithCapacity:count];
		for (i = 0; i < count; i++) {
			id string = [self itemObjectValueAtIndex:i];
			if ([string isKindOfClass:[NSString class]]) {
				[array addObject:[string wy_localizedStringFromTable:table inBundle:bundle]];
			}
			else { array = nil; break; }
		}
		if (array != nil) {
			[self removeAllItems];
			[self addItemsWithObjectValues:array];
			WYLocalize(self, stringValue, setStringValue);
		}
	}
}

@end

// -----------------------------------------------------------------------------
// windows
// -----------------------------------------------------------------------------

@implementation NSWindow (WYLocalization)

- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle
{
	[[self contentView] wy_localizeWithTable:table inBundle:bundle];
	WYLocalize(self, title, setTitle);
}
@end

// -----------------------------------------------------------------------------
// tables
// -----------------------------------------------------------------------------

@implementation NSTableView (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle {
	[super wy_localizeWithTable:table inBundle:bundle];
	[[self tableColumns] wy_localizeWithTable:table inBundle:bundle];
}
@end

@implementation NSTableColumn (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle {
	[[self headerCell] wy_localizeWithTable:table inBundle:bundle];
}
@end

@implementation NSTableHeaderCell (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle {
	if ([self image] == nil) { [super wy_localizeWithTable:table inBundle:bundle]; }
}
@end

// -----------------------------------------------------------------------------
// menus
// -----------------------------------------------------------------------------

@implementation NSMenuItem (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle {
	WYLocalize(self, title, setTitle);
	WYLocalize(self, toolTip, setToolTip);
	if ([self hasSubmenu]) { [[self submenu] wy_localizeWithTable:table inBundle:bundle]; }
}
@end

@implementation NSMenu (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle {
	WYLocalize(self, title, setTitle);
	[[self itemArray] wy_localizeWithTable:table inBundle:bundle];
}
@end

// -----------------------------------------------------------------------------
// tab-views
// -----------------------------------------------------------------------------

@implementation NSTabView (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle {
	[[self tabViewItems] wy_localizeWithTable:table inBundle:bundle];
}
@end

@implementation NSTabViewItem (WYLocalization)
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle {
	WYLocalize(self, label, setLabel);
	[[self view] wy_localizeWithTable:table inBundle:bundle];
}
@end

// -----------------------------------------------------------------------------
// autosizing
// -----------------------------------------------------------------------------

@interface ODAutosizingButton : NSButton
@end
@implementation ODAutosizingButton : NSButton
- (void)wy_localizeWithTable:(NSString *)table inBundle:(NSBundle *)bundle
{
	[super wy_localizeWithTable:table inBundle:bundle];
	NSRect r1 = [self frame];
	[self sizeToFit];
	NSRect r2 = [self frame];
	r2.size.width += 16;
	r2.origin.x -= NSWidth(r2) - NSWidth(r1);
	[self setFrame:r2];
}
@end
