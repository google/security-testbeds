#!/bin/bash
exec /lib/systemd/systemd --system --log-level=info --log-target=journal-or-kmsg
