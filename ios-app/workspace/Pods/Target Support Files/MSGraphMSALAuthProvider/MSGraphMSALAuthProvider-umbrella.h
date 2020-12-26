#ifdef __OBJC__
#import <UIKit/UIKit.h>
#else
#ifndef FOUNDATION_EXPORT
#if defined(__cplusplus)
#define FOUNDATION_EXPORT extern "C"
#else
#define FOUNDATION_EXPORT extern
#endif
#endif
#endif

#import "MSALAuthenticationProvider.h"
#import "MSALAuthenticationProviderOptions.h"
#import "MSGraphMSALAuthProvider.h"

FOUNDATION_EXPORT double MSGraphMSALAuthProviderVersionNumber;
FOUNDATION_EXPORT const unsigned char MSGraphMSALAuthProviderVersionString[];

