<?php

/**
 * starcraft2 short summary.
 *
 * starcraft2 description.
 *
 * @version 1.0
 * @author AcidSnake
 */

 namespace app\models;

class StarCraft2 extends \lithium\data\Model  
{
    //paths to replays in webroot for sc2.
    //get the file names with scandir

        //example for mapping an array
        public $dir = 'starcraft2/clanwar/replays';    
        public $sc2file = 'file.zip';

        //$file is the variable that gets passed as a value through the downloadFile Function
      
        //file name is the key
        //folder name is the index

        public $sc2replays = array(
    
            'taw'=>array(
                'id'=>'taw',
                'tags'=>'TAW',
                'name'=>'The Art Of War',
                'mpc-players'=>array(
                    'joe','moe','curly','larry','shemp'
                ),
                'players'=>array(
                    'jack','mitch','steve','chris','aaron'
                ),
                'game-rules'=>'all kill',
                'game-days'=>array(
                      'day1','day2','day3', 
                )
            ),

            'drk'=>array(
                'id'=>'drk',
                'tags'=>'DRK',
                'name'=>'Dark Society Gaming Community',
                'mpc-players'=>array(
                    'joe','moe','curly','larry','shemp'
                ),
                'players'=>array(
                    'jack','mitch','steve','chris','aaron'
                ),
                'game-rules'=>'all kill',
                'game-days'=>array(
                      'day1','day2','day3', 
                )
            ),

            'lit'=>array(
                'id'=>'lit',
                'tags'=>'|LiT|',
                'name'=>'Lost In Translation',
                'mpc-players'=>array(
                    'joe','moe','curly','larry','shemp'
                ),
                'players'=>array(
                    'jack','mitch','steve','chris','aaron'
                ),
                'game-rules'=>'all kill',
                'game-days'=>array(
                      'day1','day2','day3', 
                )
            ),
        
        );

}
