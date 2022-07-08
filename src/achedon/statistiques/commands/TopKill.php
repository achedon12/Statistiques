<?php

namespace achedon\statistiques\commands;

use achedon\statistiques\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class TopKill extends Command{

    public function __construct()
    {
        parent::__construct(
            "topkill",
            "voir le topkill du serveur",
            "/topkill",
            ["tk"]
        );

    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if(!$sender instanceof Player){
            return;
        }
        $this->sendTopKill($sender);
    }

    public function sendTopKill(Player $player){
        $config = main::kill()->getAll();
        arsort($config);
        $top = 1;
        $player->sendMessage("Top 10 Kills");
        foreach ($config as $name => $value){
            if($top === 11){
                break;
            }
            $player->sendMessage("§d{$top} §f- §d{$name} §favec §d{$value} §fkills");
            $top ++;
        }
    }
}
