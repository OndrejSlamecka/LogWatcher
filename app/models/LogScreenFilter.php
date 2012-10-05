<?php
/**
 * LogWatcher
 *
 * @link https://github.com/OndrejSlamecka/LogWatcher
 * @copyright (c) 2012 Ondrej Slamecka (http://www.slamecka.cz)
 *
 * License can be found in license.txt file located in the root folder.
 */


/**
 * Adds some extra features to existing debugger log
 *
 * @author Jan Dolecek <juzna.cz@gmail.com>
 */
class LogScreenFilter extends Nette\Object
{
    /**
     * @param Nette\Application\UI\Control $control
     * @param string $text
     * @return string
     */
    public static function process(Nette\Application\UI\Control $control, $text, $fullname)
    {
        // find Search link
        if (preg_match('~<p>[^<]+<a href="[^"]+" id="netteBsSearch">[^<]+</a></p>~mi', $text, $match, PREG_OFFSET_CAPTURE)) {
            $pos = $match[0][1] + strlen($match[0][0]);// - /* </p> */4;

	        // HTML code to be added
            $inner = "<a href=\"{$control->link('delete!', array($fullname))}\" id=\"netteBsSearch\">Delete</a>";

            $text = substr($text, 0, $pos) . $inner . substr($text, $pos);
        }

        return $text;
    }

}
