import reverb
import tensorflow as tf
import numpy as np

OBSERVATION_SPEC = tf.TensorSpec([10, 10], tf.uint8)
ACTION_SPEC = tf.TensorSpec([2], tf.float32)

def agent_step(unused_timestep) -> tf.Tensor:
  return tf.cast(tf.random.uniform(ACTION_SPEC.shape) > .5,
                 ACTION_SPEC.dtype)

def environment_step(unused_action) -> tf.Tensor:
  return tf.cast(tf.random.uniform(OBSERVATION_SPEC.shape, maxval=256),
                 OBSERVATION_SPEC.dtype)


# Initialize the reverb server.
simple_server = reverb.Server(
    tables=[
        reverb.Table(
        name='my_table',
        sampler=reverb.selectors.Prioritized(priority_exponent=0.8),
        remover=reverb.selectors.Fifo(),
        max_size=100,
        rate_limiter=reverb.rate_limiters.MinSize(1)),
    ],
    # Sets the port to None to make the server pick one automatically.
    # This can be omitted as it's the default.
    port=8888)

simple_server.wait()