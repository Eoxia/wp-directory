<?php
/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014 Rob Dunham
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace beflex_pro;

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Simple Recursive Autoloader
 *
 * A simple autoloader that loads class files recursively starting in the directory
 * where this class resides.  Additional options can be provided to control the naming
 * convention of the class files.
 *
 * @package Autoloader
 * @license http://opensource.org/licenses/MIT  MIT License
 * @author  Rob Dunham <contact@robunham.info>
 */
class Autoloader
{
	/**
	 * File extension as a string. Defaults to ".php".
	 */
	protected static $fileExt = '.php';

	/**
	 * The top level directory where recursion will begin. Defaults to the current
	 * directory.
	 */
	protected static $pathTop = __DIR__;

	/**
	 * A placeholder to hold the file iterator so that directory traversal is only
	 * performed once.
	 */
	protected static $fileIterator = null;

	/**
	 * List of directories to exclude from the search
	 */
	protected static $directory_to_exclude = array( '.git', 'node_modules', '.idea', 'vendor' );

	/**
	 * Autoload function for registration with spl_autoload_register
	 *
	 * Looks recursively through project directory and loads class files based on
	 * filename match.
	 *
	 * @param string $className
	 */
	public static function loader($className)
	{
		$directory = new \RecursiveDirectoryIterator(static::$pathTop, \RecursiveDirectoryIterator::SKIP_DOTS);

		if (is_null(static::$fileIterator)) {
			$exclude = static::$directory_to_exclude;
			static::$fileIterator = new \RecursiveIteratorIterator( new \RecursiveCallbackFilterIterator(
				$directory,
				function ($current, $key, $iterator) use ($exclude) {
					$path = $current->getPathName();

					foreach ($exclude as $ignore) {
						if (strpos($path, $ignore) !== false) {
							return false;
						}
					}
					return true;
				} )
			);
		}

		$class_name = explode( '\\', $className );
		if ( ! empty( $class_name[1] ) )
		{
			$filename = $class_name[1] . static::$fileExt;
		}
		else
		{
			$filename = $className . static::$fileExt;
		}

		foreach (static::$fileIterator as $file) {

			if ( strtolower( $file->getFilename() ) === strtolower( str_replace( '_', '-', $filename ) ) ) {
				echo '<pre>';
				print_r( $file->getFilename() );
				echo '</pre>';
				if ($file->isReadable()) {
					include_once $file->getPathname();
				}
				break;

			}

		}

	}

	/**
	 * Sets the $fileExt property
	 *
	 * @param string $fileExt The file extension used for class files.  Default is "php".
	 */
	public static function setFileExt($fileExt)
	{
		static::$fileExt = $fileExt;
	}

	/**
	 * Sets the $path property
	 *
	 * @param string $path The path representing the top level where recursion should
	 *                     begin. Defaults to the current directory.
	 */
	public static function setPath($path)
	{
		static::$pathTop = $path;
	}

}

\beflex_pro\Autoloader::setFileExt('.php');
spl_autoload_register('\beflex_pro\Autoloader::loader');
// EOF
