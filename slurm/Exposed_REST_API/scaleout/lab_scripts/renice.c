/*
 *   To compile:
 *    gcc -fPIC -std=c99 -shared -o renice.so renice.c
 *
 */
#include <sys/types.h>
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <sys/resource.h>
#include <errno.h>
#include <getopt.h>
#include <slurm/spank.h>
/*
 * All spank plugins must define this macro for the
 * Slurm plugin loader.
 */
SPANK_PLUGIN(renice, 1);
#define PRIO_ENV_VAR "SLURM_RENICE"
#define PRIO_NOT_SET 42
/*
 * Minimum allowable value for priority. May be
 * set globally via plugin option min_prio=<prio>
 */
static int min_prio = -20;
static int prio = PRIO_NOT_SET;
static int _renice_opt_process(int val, const char *optarg, int remote);
static int _str2prio(const char *str, int *p2int);
/*
 *  Provide a --renice=[prio] option to srun:
 */
struct spank_option spank_options[] = {
    {"renice", "[prio]", "Re-nice job tasks to priority [prio].", 2, 0,
     (spank_opt_cb_f)_renice_opt_process},
    SPANK_OPTIONS_TABLE_END
};
/*
 *  Called from both srun and slurmd.
 */
int slurm_spank_init(spank_t sp, int ac, char **av) {
    /* Don't do anything in sbatch/salloc */
    if (spank_context() == S_CTX_ALLOCATOR)
        return 0;
    for (int i = 0; i < ac; i++) {
        if (strncmp("min_prio=", av[i], 9) == 0) {
            const char *optarg = av[i] + 9;
            if (_str2prio(optarg, &min_prio) < 0)
                slurm_error("Ignoring invalid min_prio value: %s",
                        av[i]);
        } else {
            slurm_info("WARNING: renice: Invalid option: %s",
                   av[i]);
        }
    }
    if (!spank_remote(sp))
        slurm_verbose("renice: min_prio = %d", min_prio);
    return 0;
}
int slurm_spank_task_post_fork(spank_t sp, int ac, char **av) {
    pid_t pid;
    int taskid;
    if (prio == PRIO_NOT_SET) {
        /* See if SLURM_RENICE env var is set by user */
        char val[1024];
        if (spank_getenv(sp, PRIO_ENV_VAR, val, 1024) != ESPANK_SUCCESS)
            return 0;
        if (_str2prio(val, &prio) < 0) {
            slurm_error("Bad value for %s: %s", PRIO_ENV_VAR,
                    optarg);
            return -1;
        }
        if (prio < min_prio)
            slurm_info("WARNING: %s=%d not allowed, using min=%d",
                   PRIO_ENV_VAR, prio, min_prio);
    }
    if (prio < min_prio)
        prio = min_prio;
    spank_get_item(sp, S_TASK_GLOBAL_ID, &taskid);
    spank_get_item(sp, S_TASK_PID, &pid);
    slurm_info("re-nicing task%d pid %d to %d", taskid, pid, prio);
    if (setpriority(PRIO_PROCESS, (int)pid, (int)prio) < 0) {
        slurm_error("setpriority: %m");
        return -1;
    }
    return 0;
}
static int _str2prio(const char *str, int *p2int) {
    long int l;
    char *p;
    errno = 0;
    l = strtol(str, &p, 10);
    if (errno != 0)
        return -1;
    if ((l < -20) || (l > 20))
        return -1;
    *p2int = (int)l;
    return 0;
}
static int _renice_opt_process(int val, const char *optarg, int remote) {
    if (optarg == NULL) {
        slurm_error("renice: invalid argument!");
        return -1;
    }
    if (_str2prio(optarg, &prio) < 0) {
        slurm_error("Bad value for --renice: %s", optarg);
        return -1;
    }
    if (prio < min_prio)
        slurm_info("WARNING: --renice=%d not allowed, will use min=%d",
               prio, min_prio);
    return 0;
}

