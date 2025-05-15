# Archery Range

The Archery Range is an assortion of (stateful) testbed applications aimed at
web application security scanners. The goal is to have a testbed to evaluate the
pure detection capabilities of scanners. Orthogonal aspects such as crawling or
in-page coverage of, e.g., single page applications, need to be taken into
considerations for a high-quality scanner, however, are purposefully not part of
the goal of this testbed. For more information about a testbed aimed at crawling
capabilities feel free to take a look at the [Crawl Maze](https://github.com/google/security-crawl-maze).

## Testbed applications

The testbed applications can be found in their respective subfolders, e.g.,
`sqli/`, and contain instruction for running them locally. Testbed applications
usually serve the index page under a prefix specific to the application, e.g.,
`http://127.0.0.1/sqli/` for the SQLI testbed application. As the testbed
applications are vulnerable to high-impact issues, e.g., XXE, we advise to run
them in a container/VM.
