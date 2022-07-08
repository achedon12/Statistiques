<?php

namespace achedon\statistiques\commands;

use achedon\statistiques\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class TopDeath extends Command{

    public function __construct()
    {
        parent::__construct(
            "topdeath",
            "voir le top des morts du serveur",
            "/topdeath",
            ["td"]
        );

    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if(!$sender instanceof Player){
            return;
        }
        $this->sendTopDeath($sender);
    }

    public function sendTopDeath(Player $player){
        $config = Main::death()->getAll();
        arsort($config);
        $top = 1;
        $player->sendMessage("Top 10 morts");
        foreach ($config as $name => $value){
            if($top === 11){
                break;
            }
            $player->sendMessage("§d{$top} §f- §d{$name} §favec §d{$value} §fDeath");
            $top ++;
        }
    }
}
