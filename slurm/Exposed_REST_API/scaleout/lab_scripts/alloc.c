#define _GNU_SOURCE             /* See feature_test_macros(7) */
#include <sched.h>
#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <sys/types.h>
#include <unistd.h>
#include <errno.h>

void print_affinity()
{
	pid_t pid = getpid();
	cpu_set_t mask = {0};
	int rc, i;
	if ((rc = sched_getaffinity(pid, sizeof(cpu_set_t), &mask))) {
		printf("error: %d", rc);
		exit (1);
	}

	printf("%d: ", pid);
	for (i = 0; i < 4; i++) {
		if (CPU_ISSET(i, &mask))
			printf("%d,", i);
	}
	printf("\n");
}

void reset_affinity()
{
	int rc, i;
	pid_t pid = getpid();
	cpu_set_t mask = {0};

	for (i = 0; i < 4; i++) {
		CPU_SET(i, &mask);
	}
	if ((rc = sched_setaffinity(pid, sizeof(cpu_set_t), &mask))) {
		printf("error: %d %d %s", rc, errno, strerror(errno));
		exit (1);
}
	printf("reset affinity\n");
}

int main()
{
	int i, j;
	for (i = 1; ; i++) {
		print_affinity();
		for (j = 0; j < 999999999; j++);

		if ((i % 15) == 0)
		reset_affinity();
}

	exit(0);
}

