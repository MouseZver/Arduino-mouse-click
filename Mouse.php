<?php

declare ( strict_types = 1 );

namespace Nouvu\ArduinoNanoV3;

use Error;

class Mouse
{
	private const
		MOUSE_BUTTON_LEFT_CLICK = 'command:mouse:click:left',
		MOUSE_BUTTON_RIGHT_CLICK = 'command:mouse:click:right',
		MOUSE_BUTTON_LEFT_DOWN = 'command:mouse:press:left',
		MOUSE_BUTTON_RIGHT_DOWN = 'command:mouse:press:right',
		MOUSE_BUTTON_LEFT_UP = 'command:mouse:releaseAll:left',
		MOUSE_BUTTON_RIGHT_UP = 'command:mouse:releaseAll:right',
		MOUSE_BUTTONS_RESET = 'command:mouse:releaseAll:0';
	
	private const DELAY_CLICK = 50000;
		
	private $serial;
	
	private string $suffix = "\n";
	
	public function __construct ( 
		int $com, int $baud = 9600, string $parity = 'n', int $data = 8, int $stop = 1, 
		string $to = 'off', string $xon = 'off', string $odsr = 'off', 
		string $octs = 'off', string $dtr = 'on', string $rts = 'on', string $idsr = 'off'
	)
	{
		shell_exec ( "mode com{$com}: baud={$baud} parity={$parity} data={$data} stop={$stop} to={$to} xon={$xon} odsr={$odsr} octs={$octs} dtr={$dtr} rts={$rts} idsr={$idsr}" );
		
		$this -> serial = fopen ( 'COM' . $com, 'w' );
		
		if ( is_bool ( $this -> serial ) )
		{
			return;
		}
		
		sleep ( 2 );
		
		register_shutdown_function ( function ()
		{
			$this -> close();
		} );
		
		$this -> send( 'ea2b2676c28c0db26d39331a336c6b92' ); // start token
	}
	
	public function leftClick( string | int $val = self :: MOUSE_BUTTON_LEFT_CLICK, int $microseconds = self :: DELAY_CLICK ): void
	{
		$this -> send( $val );
		
		usleep ( $microseconds );
	}
	
	public function rightClick( string | int $val = self :: MOUSE_BUTTON_RIGHT_CLICK, int $microseconds = self :: DELAY_CLICK ): void
	{
		$this -> send( $val );
		
		usleep ( $microseconds );
	}
	
	public function leftDown( string | int $val = self :: MOUSE_BUTTON_LEFT_DOWN ): void
	{
		$this -> send( $val );
	}
	
	public function rightDown( string | int $val = self :: MOUSE_BUTTON_RIGHT_DOWN ): void
	{
		$this -> send( $val );
	}
	
	public function leftUp( string | int $val = self :: MOUSE_BUTTON_LEFT_UP ): void
	{
		$this -> send( $val );
	}
	
	public function rightUp( string | int $val = self :: MOUSE_BUTTON_RIGHT_UP ): void
	{
		$this -> send( $val );
	}
	
	public function reset( string | int $val = self :: MOUSE_BUTTONS_RESET ): void
	{
		$this -> send( $val );
	}
	
	public function send( string | int $command ): void
	{
		if ( is_resource ( $this -> serial ) )
		{
			fwrite ( $this -> serial, $command . $this -> suffix );
			
			return;
		}
		
		throw new Error( 'Serial is not resource.' );
	}
	
	public function close(): void
	{
		if ( is_resource ( $this -> serial ) )
		{
			fclose ( $this -> serial );
		}
	}
}