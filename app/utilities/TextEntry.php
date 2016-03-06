<?php

namespace app\utilities\TextEntry;

/**
 * Clas
 */
class TextEntry
{
    /**
     * Clean symbols and other unwanted data in specified text. The
     * text is assumed to be coming from any Client so we need to make
     * sure the input we get from it is always clean.
     */
    public static function Clean ($inputText)
    {
        // Remove backslash ("\") characters.
        $cleanedText = str_replace( "\\", "", $inputText );

        return $cleanedText;
    }
}

?>