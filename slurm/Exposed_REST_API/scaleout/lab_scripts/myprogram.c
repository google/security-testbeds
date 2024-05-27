#include <stdio.h>
#include <unistd.h>
   
 int main( int argc, char *argv[] )  {
  
     if( argc == 2 ) {
        printf("%s\n", argv[1]);
     }
     else if( argc > 2 ) {
        printf("Too many arguments supplied.\n");
    }
    else {
       printf("One argument expected.\n");
    }
 sleep(1);
 }

