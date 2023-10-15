<?php

namespace SafePHP;

use SafePHP\Exceptions\HashFileException;

/**
 * Generate a hash value using the contents of a given file
 *
 * @param string $algo Name of selected hashing algorithm (i.e. "md5", "sha256", "haval160,4", etc..).
 * For a list of supported algorithms see hash_algos().
 *
 * @param string $filename URL describing location of file to be hashed; Supports fopen wrappers.
 *
 * @param bool $binary When set to true, outputs raw binary data. false outputs lowercase hexits.
 *
 * @param array<string,string> $options An array of options for the various hashing algorithms.
 * Currently, only the "seed" parameter is supported by the MurmurHash variants.
 *
 * @return string Returns a string containing the calculated message digest as lowercase hexits unless
 * binary is set to true in which case the raw binary representation of the message digest is returned.
 *
 * @throws HashFileException
 */
function hash_file(string $algo, string $filename, bool $binary = false, array $options = []): string
{
    error_clear_last();
    if (!file_exists($filename)) {
        $safeResult = false;
    } else {
        $safeResult = \hash_file($algo, $filename, $binary, $options);
    }
    if (false === $safeResult) {
        $message = sprintf("hash_file(%s, %s, %s): ", $algo, $filename, $binary ? "true" : "false");
        if (!file_exists($filename)) {
            $message .= "\nFile '$filename' not found";
        }
        throw new HashFileException($message);
    }
    return $safeResult;
}
