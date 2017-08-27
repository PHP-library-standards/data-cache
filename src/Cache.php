<?php
/**
 * @package   Pls\Data\Cache
 * @author    PHP Library Standards <https://github.com/PHP-library-standards>
 * @copyright 2017 PHP Library Standards
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Pls\Data\Cache;

use Pls\Data\Container\{Container, ContainerException};

/**
 * Defines the most basic operations on a collection of cache-entries, which
 * entails basic reading, writing and deleting individual or multiple cache
 * items.
 */
interface Cache extends Container
{
    /**
     * Removes all values and keys stored in the cache.
     *
     * @return bool `true` on success, `false` otherwise.
     */
    public function clear(): bool;

    /**
     * Removes a stored value from a given key.
     *
     * @param string $key The unique key of a value in the cache.
     *
     * @return bool `true` on success, `false` otherwise.
     */
    public function delete(string $key): bool;

    /**
     * Removes multiple stored values from a given list of keys.
     *
     * @param iterable $keys A list of unique keys of values in the cache.
     *
     * @return bool `true` on success, `false` otherwise.
     */
    public function deleteMultiple(iterable $keys): bool;

    /**
     * Fetches multiple stored values from a given list of keys.
     *
     * @param iterable   $keys    A list of unique keys of values in the cache.
     * @param mixed|null $default Default value to return for keys that do
     *      not exist.
     *
     * @throws ContainerException MUST be thrown if any of the $keys are not a
     *      legal value.
     *
     * @return iterable A list of key => value pairs. Keys that do not exist or
     *      are stale will have $default as value, if given.
     */
    public function getMultiple(iterable $keys, $default = null): iterable;

    /**
     * Stores a value referenced by a given key with an optional TTL value.
     *
     * @param string                 $key   A unique key reference for `$value`.
     * @param mixed                  $value The value to store, must be
     *      serializable.
     * @param \DateInterval|int|null $ttl   Optional. The TTL value for this
     *      key => value pair. If `null` is given and the driver supports TTL
     *      then the library MAY set a default value or rely on the driver to
     *      set a value.
     *
     * @throws ContainerException MUST be thrown if the $key string is not a
     *      legal value or if the `$value` is not serializable.
     *
     * @return bool `true` on success, `false` otherwise.
     */
    public function set(string $key, $value, $ttl = null): bool;

    /**
     * Stores a set of key => value pairs with an optional TTL value.
     *
     * @param iterable               $values A list of key => value pairs.
     * @param \DateInterval|int|null $ttl    Optional. The TTL value for these
     *      key => value pairs. If `null` is given and the driver supports TTL
     *      then the library MAY set a default value or rely on the driver to
     *      set a value.
     *
     * @throws ContainerException MUST be thrown if any of the $values has an
     *      illegal key or is not serializable.
     *
     * @return bool `true` on success, `false` otherwise.
     */
    public function setMultiple(iterable $values, $ttl = null): bool;
}
