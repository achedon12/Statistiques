<?php

namespace achedon\statistiques\events;

use achedon\statistiques\main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class playerEvents implements Listener{

    public function onJoin(PlayerJoinEvent $event){

        $player = $event->getPlayer();
        $playername = $player->getName();
        $dbK = main::kill();
        $dbD = main::death();
        $dbBB = main::blockBreak();

        $list = ['diamand','fer','or'];


        if(!$player->hasPlayedBefore()){
            foreach($list as $item){
                $dbBB->setNested($playername.".".$item,0);
            }
            $dbBB->save();

            $dbK->set("$playername",0);
            $dbK->save();

            $dbD->set("$playername",0);
            $dbD->save();
        }else{
            if(!$dbD->get("$playername") != 0 or $dbK->get("$playername") != 0  or $dbBB->get("$playername") != 0){

                foreach($list as $item){
                    $dbBB->setNested($playername.".".$item,0);
                }
                $dbBB->save();

                $dbK->set("$playername",0);
                $dbK->save();

                $dbD->set("$playername",0);
                $dbD->save();
            }
        }

    }
}
