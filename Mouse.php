<?php

declare ( strict_types = 1 );

namespace Nouvu\ArduinoNanoV3;

use Error;

class Mouse
{
	private const
		MOUSE_BUTTON_LEFT_CLICK = 'L',
		MOUSE_BUTTON_RIGHT_CLICK = 'R',
		MOUSE_BUTTON_LEFT_DOWN = 2,
		MOUSE_BUTTON_RIGHT_DOWN = 4,
		MOUSE_BUTTON_LEFT_UP = 1,
		MOUSE_BUTTON_RIGHT_UP = 3,
		MOUSE_BUTTONS_RESET = 0;
	
	private const DELAY_CLICK = 50000;
		
	private $serial;
	
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
		
		register_shutdown_function ( function ()
		{
			$this -> close();
		} );
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
			fwrite ( $this -> serial, ( string ) $command );
			
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