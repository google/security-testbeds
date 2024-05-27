#include <inttypes.h>
#include <stdint.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/types.h>
#include <unistd.h>

int main(int argc, char *argv[])
{
	uint64_t tot = 0;
	int grow_by = 10;
	setbuf(stdout, NULL);
	argv[0] = "blah";
	while (1) {
		int i = 0;
		char *m;
		if (!(m = calloc(grow_by * 1024 * 1024, 1)))
			printf("Failed to allocate memory");
		for (; i < grow_by * 1024 * 1024; i++)
			m[i] = 'a';
		tot += grow_by;
		printf("pid: %d, Tot mem=%" PRIu64 "mb\n", getpid(), tot);
		sleep(1);
	}
	return 0;
}
