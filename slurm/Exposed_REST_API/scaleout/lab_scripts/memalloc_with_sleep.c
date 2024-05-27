#include <stdlib.h>
#include <unistd.h>
int main(int argc, char **argv)
{
	while (1) {
		malloc(256);
		usleep(100);
	};
}
