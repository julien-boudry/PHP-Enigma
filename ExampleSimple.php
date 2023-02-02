<?php
/**
 * @author Rafal Masiarek <rafalmasiarek@hotmail.com>
 * @author  Mustache Lab <kontakt@mustachelab.pl>
 * @copyright Copyright (c) 2015, Rafal Masiarek
 * @version 2.0
 * @package Enigma
 */
/*

                                                                      `.:'+###++++++#++##+;:.`
                                                                `:+##+++++++++++++++++++++++++++##+:`
                                                            :+##+++++++++++++#++++++++++++++++++++++++##;`
                                                        ;##+++++++++++++++++#+++++++++#++++++++++++++++#++##'`
                                                    ,###++#++++++++++####+++';::,,,::;'+++###+++++++++++++++++##:
                                                `:#+++++++++++####+;,                         .;'####++#++#++++++##'`
                                              ;@++++++++#++##':                                     ,;###+##+++++++#+#;
                                           ;@++++++++++##'.                                             `:##++++#+++++++@:
                                        .##+++++++++#+.                                                     `+#++++#++++++#+`
                                      '#++#+++#++#'`                         .:''+#####+,                       ;#+++++++++++#,
                                   .#+#+++++++#'`              `'###      .@+++++++++++++#'     @',`               ;##+++++++++#;
                                 ;@++++++++##.                @++++#     ++++++++++++++++++#`   #+++#@+:             `+#++++++++##+
                               +#++++++++#;                   #+#++#    :+++#+++++++++++++++#   ##+++++++##;`           ,#+++++++#++#
                            `##+++++##+#.                     ##+++#    #+++++++#+;:'#++++++++  #+++++++++++##+.          `+####++++#+#`
                          .##+++++#+#+`          `:++;,       #++++#    @#++++#,      ;++++++#  #+++++++++++++++##,          '#+++++++#+#`
                        .@+#++++++#+          `'#++++++#;     #++++#    @+++++'        #+++++#  #+++++;#+++++++++++#'          ;#+++++++++#`
                      .#++++++++#+          ;@+++++++++++#    #++++#    @+++++'        #+++++#  #++++#`.#++++++#+++++#           ;#++++++++++
                    .#+++++#+++#         `##++++++++++++++.   #++++#    @+++++'        #+++++#  #++++#  .+++++++++++++#            '#++++++++#+
                   #++#++++++#`         @++#++++++++++++++#   #++++#    @+++++'           ````  #++++#   +#+++'#+++++++'             ++++++++++#:
                 ++++++++++#,       `.  #+++++##. `+#+++++@   #++++#    @+++++'                 #++++#   ,++++' ++#+++++        `      #++#++++++#`
               :#++++++++#'       `#+,  #++++#      ++++++@   #++++#    @+++++'                 #++++#   :++++'  #++++++       +++`     .#++++++++++
              #+++++++#+#        +#++,  #++++#      :++++#@   #++++#    @#++++'                 #++++#   :++++;  ,+++++'      ;++##+      :#++++++++#.
            ,#+++++++++;       ;#+#++,  @#+++#      :+++++@   #++++#    @+++++'                 #++++#   :++++;  `#++++'      #+++++#+      #+++++++++'
           +++++++++##`      ,#+#++++:  #++++#      ,+++++#   #++++#    @+++++'                 #++++#   ;++++:   #++++'     #++#+++#+#'     ,#++++++#+#
          #++++++++++       #+++++++#;  #++++#      ,+++++#   #++++#    @+++++'                 #++++#   ;++++:   #++++;    ,++++#++++++#'     +++++++++#
         ##+++++++#.      '#++++#+#;    #++++#      ,+++++#   #++++#    @+++++'                 #++++#   ;++++,  `#++++;    #++++ ;#++#+++#     .#+++++++#
        #++++++++#      `#++++++#;      ##+++#      .+++++#   #++++#    @+++++'                 #++++#   ;++++,  `#++++:   .+#++#   ;+#+++#       #+++++++#
       '++++++++@      :#++#+++#        +++++#      .+++++#   #++++#    @+++++;                 #++++#   '++++,  `+++++:   ##+++,    @+++++        :#++++++#
      `++++++++#      +++++++#`         +++++#      `+++++#   #++++#    @+++++;                 #++++#   '++++.  `+++++,   #+++#     @+++++        ;#++++++++
      #+++++++++#`    #++++++           +++++#      `+++++#   #++++#    @+++++;                 #++++#   '++++.  `+++++.  .++++#     #+++++       #++++++++++`
     `+++++++++++#    #++++'            '++++#      `+++++#   #++++#    @+++++;                 #++++#   '++++.  `+++++.  '++++'     #++++'      #+++++++++++#
     +++++++++++++;   #++++;            '++++#      `+++++#   #++++#    @+++++;                 #++++#   '++++`  `+++++`  +++++`     #++++'     :+#++++++++++#
     #++++#'#+++++#   #++++;            '++++#      `+++++#   #++++#    @+++++;                 #++++#   +++++`  `+++++`  #++++      #++++;     #++#++##+#++++;
     ++++#   ;++++#   #++++',,,,::`     ;++++#      `+++++#   #++++#    @+++++;  .............  #++++#   +++++`  .+++++   #+++#      +++++:     #++++   ;+++++#
     +++++    #++++   +#++++++++++.     ;++++#       #++++#   #++++#    @+++++;  ##++++++++#++  #++++#   ++++#`  .+++++   #+++#      +++++:    `#+++#    #+++++
     ++++#   .+++#+   ++++++++++++,     :++++#       #++++#   #++++#    @+++++;  @++++++++++++  #++++#   ++++#`  .+++++   +++++    '#+++++,    `#+++#   .#+++++
     #++++#`:#++++#   '+++++++++++:     :++++#       #++++#   #++++#    @+++++;  @++++++++++++  #++++#   ++++#`  ,++++#  .#++++ :#++#+++++.     #+++++ .#++++++
     ++#+++++++++#+   ;#++++++++++:     ,+++++`      #++++#   #++++#    #+++++;  @++++#++++++'  #++++#   ++++#   ,++++#  :#++++#++++++++++.     #+#++++++++++++
     ;#++++++++++#`   ;+++++            .+++++`      #++++#   ##+++#    #+++++;  `      #++++'  #++++#   ++++#   :++++#  ;++++++++++++++++`     .+++++++++++++.
      ##+++++++++;    :++++'            .+++++`      #++++#   #++++#    #+++++;         #++++'  #++++#   #+++#   :++++#  '++++++++#':++++#`      +++++++++++##
      +++++++++#:     ,++++'            `+++++`      #++++#   #++++#    #+++++;         #++++'  #++++#   #+++#   :++++#  '++++++#;  :++++#`       +++++++++++:
       #++++++#       ,++++#`           `+++++`      #++++#   #++++#    #+++++;         #++++'  #++++#   #+++#   ;++++#  '++++#,    ;++++#         +#++++++##
        ++++++++      .+++++++           +++++.      #++++#   +++++#`   #+++++;         #++#+;  #++++#   #+++#   ;++++#  +++++      ;++++#        #+#++++++#
        .###++++#     .#++++#+#+`        +++++.      #+++++   +++++#`   #+++++:         #++++;  #++++#   #+++#   '++++#  +++++`     ;++++#      ;+++++++++#
         `#++++#+#,     ##+++++++@:      #++++,      #+++++   +++++#`   #+++++:         #++++;  #++++#   #+++#   '++++#  +++++`     ;++#+#    `@#++++++++#
           #++++++++     .#+#++++++#@'   #++++,      #+++++   +++++#`   #+++++:         #++++;  #++++#   #+++#   '++++#  +++++`     ;++#+    +++++++++++#
            #++++++##,     .#++++++#++   #++++:      #+++++   '++++#`   #+++++:         #++++;  #+++++   #+++#   +++++#  +++++`     '#;    ,#++#++++++#:
             ,#+++++++#      `+#+++++#`  #++++:      #+++++   '++++#`   ++#+++:         #++++:  #+++++   @+++#   +++++#  #++++`     .    `#+#++#+++++#
               ++++++++#'       :##+++.  #++++:      #+++++   '++++#`   ++++++:         #++++:  #+++++   @+++#   +++++#  #++++.         #++++++++++#:
                `#+#+++++#'       `+#+,  #++++;      #+++++   ;++++#`   ++++++:         #++++:  #++++'   @+++#   +++++#  #+++#,       +++#++++#++#+
                  ,#++#++++#;        ;:  #++++;      #+++++   ;+++++`   ++++++:         #++++:  #++++'   @+++#   +++++#  #+#;       +#++++++++++#`
                    ;#+++++++#;          @++++'      #+++++   :+++++`   ++++++:         #++++,  #++++'   @+++#   #+++++  '`       +#+++++++#++@.
                      ;#+++++++#+         .+#+'      #+++++   :+++++`   ++++++,         #++++,  #++++;   @+++#   #+#+##         +#++++++++++#:
                        ;#++#+#++##.         ,+      #+++#+   :+++++`   ++++++,         #++++,  #++++;   @+#+#   ###,        .#+++++++++++#;
                          ;#++#+++++#'               #+++++`  ,+++++`   ++++++#        ;+++#+.  #++++:   #+++#   .         ;#+++++++++++#;
                            ,@+#++++++##,            @#++++`  ,+++++.   +++++++#:.```,#++++#+`  #++++:   #+#@+          .+#+++++++++###;
                              .#+##++++++#+,           ,'@+`  ,+#+++.   ,+++++++++###+++++++#   #++#+:   '.           ;#++++++++++++@:
                                 ;#+++++#+++#+:               ,+++++.    #++++++++#+++++++++.   #+##'`             ;##+#++++++++++#.
                                   .##+++++++++##'`            `'###.     #+++++++++#++++++'    `              `'#+++++++++++++#'
                                      :##+#++++++++##;`                    ,#++++++++++++#:                 .##+++++++++++++##.
                                         ;@+++++++++++###;.                   .........`                ,+##++++#+++++++++#:
                                            :@+++++++++++++###;,                                   ,;+##+++++++++#+++++@,
                                               .###+#+++++++++++###++':`                    .:'+###++++++++++++#+++#+.
                                                   ,+##++++++++++#+++++++######++++++######+++#+++#++++++++++#+#+:
                                                       ,'##+#+++++++++++++++++++++++++++++++++++++++++++++##+:
                                                            ,'@#+++++++++++++++++++++++++++++++++++++##+:`
*/

declare(strict_types=1);

use Rafalmasiarek\Enigma\{Enigma, EnigmaModel, ReflectorType, RotorPosition, RotorType};

require_once 'vendor/autoload.php';

$rotors = [RotorType::I, RotorType::II, RotorType::III];
$enigma = new Enigma(EnigmaModel::WMLW, $rotors, ReflectorType::B);
$enigma->setPosition(RotorPosition::P1, 'M');
$enigma->setRingstellung(RotorPosition::P1, 'B');

$enigma->plugLetters('A', 'C');
$enigma->plugLetters('B', 'Z');

$enigma->unplugLetters('A');

$l = 'A';
echo 'before: '.$enigma->getPosition(RotorPosition::P3).' '.$enigma->getPosition(RotorPosition::P2).' '.$enigma->getPosition(RotorPosition::P1)."\n";
echo $l.'->'.$enigma->encodeLetter($l)."\n";
echo 'after: '.$enigma->getPosition(RotorPosition::P3).' '.$enigma->getPosition(RotorPosition::P2).' '.$enigma->getPosition(RotorPosition::P1)."\n";
