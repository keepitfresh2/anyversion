<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace zyware\AnyVersion\Packets\v12;

use pocketmine\utils\Binary;

use pocketmine\network\mcpe\NetworkSession;

class ShowStoreOfferPacket extends DataPacket{
	public const NETWORK_ID = ProtocolInfo::SHOW_STORE_OFFER_PACKET;

	/** @var string */
	public $offerId;
	/** @var bool */
	public $unknownBool;

	protected function decodePayload(){
		$this->offerId = $this->getString();
		$this->unknownBool = (($this->get(1) !== "\x00"));
	}

	protected function encodePayload(){
		$this->putString($this->offerId);
		($this->buffer .= ($this->unknownBool ? "\x01" : "\x00"));
	}

	public function handle(NetworkSession $session) : bool{
		return $session->handleShowStoreOffer($this);
	}
}
