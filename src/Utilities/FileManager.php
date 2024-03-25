<?php

namespace Devinci\LaravelEssentials\Utilities;

/**
 * FileManager class provides utility methods for file management.
 */
class FileManager
{
    /**
     * Array to store namespace replacement pairs.
     *
     * @var array
     */
    private static $namespaceReplacements = [];

    /**
     * Array to store strings that should be excluded from refactoring.
     *
     * @var array
     */
    private static $excludeList = [];

    /**
     * Adds a namespace replacement pair.
     *
     * @param string $oldNamespace The old namespace to be replaced.
     * @param string $newNamespace The new namespace to replace the old one.
     * @return void
     */
    public static function addNamespaceReplacement($oldNamespace, $newNamespace)
    {
        self::$namespaceReplacements[$oldNamespace] = $newNamespace;
    }

    /**
     * Adds a string to the exclusion list for refactoring.
     *
     * @param string $string The string to be excluded from refactoring.
     * @return void
     */
    public static function addRefactorExclusion($string)
    {
        self::$excludeList[] = $string;
    }

    /**
     * Reads the content of a file.
     *
     * @param string $filePath The path to the file to be read.
     * @return string The content of the file.
     */
    public static function readFile($filePath)
    {
        return file_get_contents($filePath);
    }

    /**
     * Writes content to a file.
     *
     * @param string $filePath The path to the file to be written.
     * @param string $content The content to be written to the file.
     * @return void
     */
    public static function writeFile($filePath, $content)
    {
        $directory = dirname($filePath);

        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        file_put_contents($filePath, $content);
    }

    /**
     * Refactors content by replacing old namespace with new namespace.
     *
     * @param string $content The content to be refactored.
     * @return string The updated content after refactoring.
     */
    public static function refactorContent($content)
    {
        foreach (self::$namespaceReplacements as $oldNamespace => $newNamespace) {
            $content = self::replaceNamespace($content, $oldNamespace, $newNamespace);
        }

        return $content;
    }

    /**
     * Checks if a path exists.
     *
     * @param string $path The path to check.
     * @return bool True if the path exists, false otherwise.
     */
    public static function pathExists($path)
    {
        return file_exists($path);
    }

    /**
     * Replaces old namespace with new namespace in the content.
     *
     * @param string $content The content in which namespace is to be replaced.
     * @param string $oldNamespace The old namespace to be replaced.
     * @param string $newNamespace The new namespace to replace the old one.
     * @return string The updated content after namespace replacement.
     */
    private static function replaceNamespace($content, $oldNamespace, $newNamespace)
    {
        // Replace namespace declarations
        $oldNamespacePattern = '/\bnamespace\s+' . preg_quote($oldNamespace, '/') . '\b/';
        $newNamespaceDeclaration = 'namespace ' . $newNamespace;
        $content = preg_replace($oldNamespacePattern, $newNamespaceDeclaration, $content);

        // Replace use statements
        $oldUseStatement = 'use ' . $oldNamespace;
        $newUseStatement = 'use ' . ucfirst($newNamespace);
        $content = str_replace($oldUseStatement, $newUseStatement, $content);

        return $content;
    }
}
