<?php

namespace achedon\statistiques\commands;

use achedon\statistiques\UI\AdminStatsUI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class AdminStats extends Command{

    public function __construct()
    {
        parent::__construct(
            "astats",
            "voir les stats d'un joueur",
            "/astats"
        );
        $this->setPermission("use.adminstats");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if($sender instanceof Player){
            if(!empty($args[0])){
                if($args[0] instanceof Player){
                    if($sender->hasPermission("use.adminstats")){
                        AdminStatsUI::adminstats($sender);
                    }else{
                        $sender->sendMessage("§4/!\ §fTu n'as pas la permission d'utiliser cette commande");
                    }
                }else{
                    $sender->sendMessage("§4/!\ §fVeuillez indiquer un pseudo valide");
                }
            }else{
                $sender->sendMessage("§4/!\ §fVeuillez indiquer un nom de joueur pour voir ses statistiques");
            }
        }else{
            $sender->sendMessage("Commande à utiliser en jeu");
        }

    }
}
