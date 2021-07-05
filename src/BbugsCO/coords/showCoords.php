<?php

   //This program is free software: you can redistribute it and/or modify
   //it under the terms of the GNU General Public License as published by
   //the Free Software Foundation, either version 3 of the License, or
   // (at your option) any later version.

namespace BbugsCO\coords; 

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\plugin\PluginManager;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\scheduler\TaskHandler;
use pocketmine\network\mcpe\protocol\GameRulesChangedPacket;
use pocketmine\utils\Config;


class showCoords extends PluginBase implements Listener {

    public function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("Coords Plugin Enabled");
	}
	
	
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
		if($command->getName() === "coords"){
			if(!$sender->hasPermission("coords.command")){
				$sender->sendMessage("You can not run this command because you do not have permission");
				return false;
			}
			if(!$sender instanceof Player){
				$sender->sendMessage("You can not run this command from console");
				return false;
			}
			
			$pk = new GameRulesChangedPacket();
            $pk->gameRules = ["showcoordinates" => [1, true, true]];
			$sender->dataPacket($pk);
            $sender->sendMessage("Coords enabled");
		}
		return true;
	}
}
