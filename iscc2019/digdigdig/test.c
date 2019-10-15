/*
 * @file test.c
 * @brief test
 * @author Anemone,x565178035@126.com
 * @version 1.0
 * @date 2019-05-14 15:18
 */

#include <errno.h>
#include <math.h>
#include <stdlib.h>
#include <string.h>
#include <stdio.h>

int main(int argc,char *argv[])
{
    if(argc>=2)
    {
        if (!strcmp(argv[1],"HelloWorld!")) {
            printf("hello\n");
        } else {
            printf("wrong\n");
        }
    }

    return 0;
}
