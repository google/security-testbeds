#!/bin/bash

# No arguments, exit
if [ -z "$*" ]; then
  echo "No command specified; exiting Tsunami CLI"
  exit;
fi

# If the --json flag is specified (any position), set the environment variable and remove the flag
args=()
for arg in "$@"; do
    if [ "$arg" = "--json" ]; then
        export OUTPUT_JSON="json"
    elif [ "$arg" = "--short" ]; then
        export OUTPUT_JSON="short"
    else
        args+=("$arg")
    fi
done

setup_classpath() {
    classpath="tsunami.jar"
    if [ "${USE_CUSTOM_PLUGINS}" = "true" ]; then
        classpath="${classpath}:custom_plugins/*.jar"
    fi

    if [ -z "${USE_DEFAULT_PLUGINS}" ] || [ "${USE_DEFAULT_PLUGINS}" = "true" ]; then
        classpath="${classpath}:plugins/*.jar"
    fi
    echo "${classpath}"
}

# If --json was specified, only output JSON
if [[ -n "${OUTPUT_JSON}" ]]; then
    echo "Running Tsunami in JSON output mode ($(pwd))" >&2
    echo "Classpath: $(setup_classpath)" >&2

    java -cp "$(setup_classpath)" -Dtsunami-config.location=tsunami.yaml \
        com.google.tsunami.main.cli.TsunamiCli \
        --scan-results-local-output-format=JSON \
        --scan-results-local-output-filename=output.json \
        "${args[@]}" >./original_output.txt 2>&1 &
    tsunami_pid=$!

    # Wait a few seonds and check if Tsunami is still running
    sleep 10
    if ! kill -0 $tsunami_pid 2>/dev/null; then
        echo "Tsunami exited early; here's the output:" >&2
        cat original_output.txt >&2
        exit 1
    fi

    wait $tsunami_pid; sleep 2
    echo "Tsunami exited" >&2
    if [[ -f output.json ]]; then
        if [[ ${OUTPUT_JSON} == "short" ]]; then
            cat output.json | jq '.scanFindings[] | {targetInfo, vulnerability, networkService: .networkService | {networkEndpoint, transportProtocol, serviceName}}'
        else
            cat output.json
        fi
    else
        echo "No output.json file found" >&2
    fi
else
    # Otherwise just run the command with original output style
    java -cp "$(setup_classpath)" -Dtsunami-config.location=tsunami.yaml \
        com.google.tsunami.main.cli.TsunamiCli "${args[@]}" 2>&1
fi
