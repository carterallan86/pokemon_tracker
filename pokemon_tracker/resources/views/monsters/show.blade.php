@extends('layouts.app')


@section('content')

   

    <div class='well'>
                        
            <table width='100%' align='center' cellspacing='3'>
                    <tr>
                @if($previous)
                
                    <td width=10% class='left'><a href="{{ route( 'monsters.show', $previous ) }}" class="btn btn-default"><img src='/storage/images/front_normal/{{$previous}}.png' alt='{{$previous}}' title='{{$previous}}'></br><h3>Previous</h3></a></td>
                @endif
                
                    <td width=10% class='left'><img src='/storage/images/front_normal/{{$monster->id}}.png' alt='{{$monster->name}}' title='{{$monster->name}}'></br><h3>{{$monster->name}}<h3></td>
        
                @if($next)
                <td width=10% class='left'><a href="{{ route( 'monsters.show', $next ) }}" class="btn btn-default"><img src='/storage/images/front_normal/{{$next}}.png' alt='{{$next}}' title='{{$next}}'></br><h3>Next</h3></a></td>
                @endif
                </tr>
            </table>
        
        <table width='100%' align='center' cellspacing='3'>
            <tr>
                <th colspan='6'>Description</th>
            </tr>
            <tr>
                <th>National No.</th>
                <th>Generation</th>
                <th>Type</th>
                <th>Height</th>
                <th>Weight</th>
                <th>Description</th>
            </tr>
            <tr>
                <td width=10%>{{$monster->target}}</td>
           
                <td width=10%>{{$monster->type1}}</td>
           

            @if($monster->type2 == 'None')    
                <td>
                    <center>
                        <img src='/storage/images/types/{{$monster->type1}}.png' alt='{{$monster->type1}}' title='{{$monster->type1}}'>
                    </center>
                </td>
            @else
                <td>
                    <center>
                        <img src='/storage/images/types/{{$monster->type1}}.png' alt='{{$monster->type1}}' title='{{$monster->type1}}'>
                        <img src='/storage/images/types/{{$monster->type2}}.png' alt='{{$monster->type2}}' title='{{$monster->type2}}'>   
                    </center>       
                </td>
            @endif
                <td width=10%>{{$monster->height}} m</td>
                <td width=10%>{{$monster->weight}} kg</td>
                <td width=50%>{{$monster->description}}</td>
            </tr>
        </table>

        <br>		
		
        <table width='100%' align='center' cellspacing='3'>
            <tr>
                <th colspan='6'>Breeding</th>
            </tr>
            <tr>
                <th>Egg groups</th>
                <th>Gender ratio</th>
                <th>Hatch steps</th>
                <th>Catch rate</th>
                <th>Catch chance</th>
                <th>Habitant</th>
            </tr>
            <tr>
                <td width=16%>{{$monster->eggGroups}}</td>
                <td  width=16%><b>Male ratio:</b> {{$monster->genderRatio}}<br><b>Female ratio:</b> {{100 - $monster->genderRatio}}</td>
                <td  width=16%>{{$monster->hatchSteps}}</td>
                <td  width=16%>{{$monster->catchRate}}</td>
                <td  width=16%>{{catchCalculate(100,100,1,1,$monster->catchRate)}}</td>
                <td  width=16%><center><img src='/storage/images/habitat/{{$monster->habitat}}.png' alt='{{$monster->habitatname}}' title='{{$monster->habitatname}}'></center></td>
            </tr>
        </table>

        
        <table width='100%' align='center' cellspacing='3'>
            <tr>
                <th colspan='3'>Abilities</th>
            </tr>
            <tr>
                <th>Ability #1</th>
                <th>Ability #2</th>
                <th>Hidden Ability</th>
            <tr>
                <td width=33%>{{$monster->a1name}}: {{$monster->a1effect}}</td>
                @if ($monster->abilityId2 != 0)
                    <td width=33%>{{$monster->a2name}}: {{$monster->a2effect}}</td>
                @else
                    <td width=33%>This Pokemon don't have a second ability.</td>
                @endif
                @if ($monster->abilityId3 != 0)
                    <td width=33%>{{$monster->a3name}}: {{$monster->a3effect}}</td></tr></table>
                @else
                    <td width=33%>This Pokemon don't have a hidden ability.</td>
                @endif
            </tr>
        </table>

        
		<table width='100%' align='center' cellspacing='3'>
			<tr>
                <th colspan='8'>Stats</th>
            </tr>
			<tr>
                <th class='hidden'></th>
                <th class='hidden'></th>
                <th>HP</th><th>Attack</th>
                <th>Defense</th>
                <th>Sp. Attack</th>
                <th>Sp. Defense</th>
                <th>Speed</th>
            </tr>
			<tr>
                <td colspan='2'>Base stats</td>
				<td class='center' width=12%>{{$monster->baseHp}}</td>
				<td class='center' width=12%>{{$monster->baseAttack}}</td>
				<td class='center' width=12%>{{$monster->baseDefense}}</td>
				<td class='center' width=12%>{{$monster->baseSpecialAttack}}</td>
				<td class='center' width=12%>{{$monster->baseSpecialDefense}}</td>
                <td class='center' width=12%>{{$monster->baseSpeed}}</td>
            </tr>
			<tr>
                <td rowspan='2'>Max Stats <br> <i>Negativ nature</i></td>
				<td>Level 50</td>
                <td class='center' width=12%>{{hpCalculate($monster->baseHp,$monster->hpEV,"min",50,"-")}} - {{hpCalculate($monster->baseHp,$monster->hpEV,"max",50,"-")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseAttack,$monster->attackEV,"min",50,"-")}} - {{statCalculate($monster->baseAttack,$monster->attackEV,"max",50,"-")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseDefense,$monster->defenseEV,"min",50,"-")}} - {{statCalculate($monster->baseDefense,$monster->defenseEV,"max",50,"-")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseSpecialAttack,$monster->specialAttackEV,"min",50,"-")}} - {{statCalculate($monster->baseSpecialAttack,$monster->specialAttackEV,"max",50,"-")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseSpecialDefense,$monster->specialDefenseEV,"min",50,"-")}} - {{statCalculate($monster->baseSpecialDefense,$monster->specialDefenseEV,"max",50,"-")}}</td>
                <td class='center' width=12%>{{statCalculate($monster->baseSpeed,$monster->speedEV,"min",50,"-")}} - {{statCalculate($monster->baseSpeed,$monster->speedEV,"max",50,"-")}}</td>
            </tr>
			<tr>
                <td>Level 100</td>
				<td class='center' width=12%>{{hpCalculate($monster->baseHp,$monster->hpEV,"min",100,"1")}} - {{hpCalculate($monster->baseHp,$monster->hpEV,"max",100,"1")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseAttack,$monster->attackEV,"min",100,"-")}} - {{statCalculate($monster->baseAttack,$monster->attackEV,"max",100,"-")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseDefense,$monster->defenseEV,"min",100,"-")}} - {{statCalculate($monster->baseDefense,$monster->defenseEV,"max",100,"-")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseSpecialAttack,$monster->specialAttackEV,"min",100,"-")}} - {{statCalculate($monster->baseSpecialAttack,$monster->specialAttackEV,"max",100,"-")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseSpecialDefense,$monster->specialDefenseEV,"min",100,"-")}} - {{statCalculate($monster->baseSpecialDefense,$monster->specialDefenseEV,"max",100,"-")}}</td>
                <td class='center' width=12%>{{statCalculate($monster->baseSpeed,$monster->speedEV,"min",100,"-")}} - {{statCalculate($monster->baseSpeed,$monster->speedEV,"max",100,"-")}}</td>
            </tr>
			<tr>
                <td rowspan='2'>Max Stats <br> <i>Natural nature</i></td>
				<td>Level 50</td>
				<td class='center' width=12%>{{hpCalculate($monster->baseHp,$monster->hpEV,"min",50,"1")}} - {{hpCalculate($monster->baseHp,$monster->hpEV,"max",50,"1")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseAttack,$monster->attackEV,"min",50,"1")}} - {{statCalculate($monster->baseAttack,$monster->attackEV,"max",50,"1")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseDefense,$monster->defenseEV,"min",50,"1")}} - {{statCalculate($monster->baseDefense,$monster->defenseEV,"max",50,"1")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseSpecialAttack,$monster->specialAttackEV,"min",50,"1")}} - {{statCalculate($monster->baseSpecialAttack,$monster->specialAttackEV,"max",50,"1")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseSpecialDefense,$monster->specialDefenseEV,"min",50,"1")}} - {{statCalculate($monster->baseSpecialDefense,$monster->specialDefenseEV,"max",50,"1")}}</td>
                <td class='center' width=12%>{{statCalculate($monster->baseSpeed,$monster->speedEV,"min",50,"1")}} - {{statCalculate($monster->baseSpeed,$monster->speedEV,"max",50,"1")}}</td>
            </tr>
			<tr>
                <td>Level 100</td>
				<td class='center' width=12%>{{hpCalculate($monster->baseHp,$monster->hpEV,"min",100,"1")}} - {{hpCalculate($monster->baseHp,$monster->hpEV,"max",100,"1")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseAttack,$monster->attackEV,"min",100,"1")}} - {{statCalculate($monster->baseAttack,$monster->attackEV,"max",100,"1")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseDefense,$monster->defenseEV,"min",100,"1")}} - {{statCalculate($monster->baseDefense,$monster->defenseEV,"max",100,"1")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseSpecialAttack,$monster->specialAttackEV,"min",100,"1")}} - {{statCalculate($monster->baseSpecialAttack,$monster->specialAttackEV,"max",100,"1")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseSpecialDefense,$monster->specialDefenseEV,"min",100,"1")}} - {{statCalculate($monster->baseSpecialDefense,$monster->specialDefenseEV,"max",100,"1")}}</td>
                <td class='center' width=12%>{{statCalculate($monster->baseSpeed,$monster->speedEV,"min",100,"1")}} - {{statCalculate($monster->baseSpeed,$monster->speedEV,"max",100,"1")}}</td>
            </tr>
			<tr>
                <td rowspan='2'>Max Stats <br> <i>Positive nature</i></td>
				<td>Level 50</td>
				<td class='center' width=12%>{{hpCalculate($monster->baseHp,$monster->hpEV,"min",50,"+")}} - {{hpCalculate($monster->baseHp,$monster->hpEV,"max",50,"+")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseAttack,$monster->attackEV,"min",50,"+")}} - {{statCalculate($monster->baseAttack,$monster->attackEV,"max",50,"+")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseDefense,$monster->defenseEV,"min",50,"+")}} - {{statCalculate($monster->baseDefense,$monster->defenseEV,"max",50,"+")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseSpecialAttack,$monster->specialAttackEV,"min",50,"+")}} - {{statCalculate($monster->baseSpecialAttack,$monster->specialAttackEV,"max",50,"+")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseSpecialDefense,$monster->specialDefenseEV,"min",50,"+")}} - {{statCalculate($monster->baseSpecialDefense,$monster->specialDefenseEV,"max",50,"+")}}</td>
                <td class='center' width=12%>{{statCalculate($monster->baseSpeed,$monster->speedEV,"min",50,"+")}} - {{statCalculate($monster->baseSpeed,$monster->speedEV,"max",50,"+")}}</td>
            </tr>
			<tr>
                <td>Level 100</td>
				<td class='center' width=12%>{{hpCalculate($monster->baseHp,$monster->hpEV,"min",100,"+")}} - {{hpCalculate($monster->baseHp,$monster->hpEV,"max",100,"+")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseAttack,$monster->attackEV,"min",100,"+")}} - {{statCalculate($monster->baseAttack,$monster->attackEV,"max",100,"+")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseDefense,$monster->defenseEV,"min",100,"+")}} - {{statCalculate($monster->baseDefense,$monster->defenseEV,"max",100,"+")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseSpecialAttack,$monster->specialAttackEV,"min",100,"+")}} - {{statCalculate($monster->baseSpecialAttack,$monster->specialAttackEV,"max",100,"+")}}</td>
				<td class='center' width=12%>{{statCalculate($monster->baseSpecialDefense,$monster->specialDefenseEV,"min",100,"+")}} - {{statCalculate($monster->baseSpecialDefense,$monster->specialDefenseEV,"max",100,"+")}}</td>
                <td class='center' class='center' width=12%>{{statCalculate($monster->baseSpeed,$monster->speedEV,"min",100,"+")}} - {{statCalculate($monster->baseSpeed,$monster->speedEV,"max",100,"+")}}</td>
            </tr>
        </table>


		<table width='100%' align='center' cellspacing='3'>
			<tr>
                <th colspan='4'>Sprites</th>
            </tr>
			<tr>
                <th>Front Normal</th>
                <th>Front Shiny</th>
                <th>Back Normal</th>
                <th>Back Shiny</th>
            </tr>
			<tr height='96px'>
                <td><center><img src='/storage/images/front_normal/{{$monster->id}}.png' alt='$name' title='$name'></center></td><td><center><img src='/storage/images/front_shiny/{{$monster->id}}.png' alt='$name' title='$name'></center></td>
                <td><center><img src='/storage/images/back_normal/{{$monster->id}}.png' alt='$name' title='$name'></center></td><td><center><img src='/storage/images/back_shiny/{{$monster->id}}.png' alt='$name' title='$name'></center></td>
            </tr>
        </table>				
				
		<table width='100%' align='center' cellspacing='3'>
			<tr>
                <th colspan='4'>Moving sprites</th>
            </tr>
			<tr>
                <th>Front Normal</th>
                <th>Front Shiny</th>
                <th>Back Normal</th>
                <th>Back Shiny</th>
            </tr>
            <tr height='96px'><td><center><img src='/storage/images/front_normal_moving/{{$monster->id}}.gif' alt='$name' title='$name'></center></td>
                <td><center><img src='/storage/images/front_shiny_moving/{{$monster->id}}.gif' alt='$name' title='$name'></center></td><td><center><img src='/storage/images/back_normal_moving/{{$monster->id}}.gif' alt='$name' title='$name'></center></td>
                <td><center><img src='/storage/images/back_shiny_moving/{{$monster->id}}.gif' alt='$name' title='$name'></center></td>
            </tr>
        </table>

        @php
        $DTNormal = 1;
        $DTFire = 1;
        $DTWater = 1;
        $DTElectric = 1;
        $DTGrass = 1;
        $DTIce = 1;
        $DTFighting = 1;
        $DTPoison = 1;
        $DTGround = 1;
        $DTFlying = 1;
        $DTPsychic = 1;
        $DTBug = 1;
        $DTRock = 1;
        $DTGhost = 1;
        $DTDragon = 1;
        $DTDark = 1;
        $DTSteel = 1;
        damageTaken($monster->type1, $monster->type2, $DTNormal, $DTFire, $DTWater, $DTElectric, $DTGrass, $DTIce, $DTFighting, $DTPoison, $DTGround, $DTFlying, $DTPsychic, $DTBug, $DTRock, $DTGhost, $DTDragon, $DTDark, $DTSteel);
        $DDNormal = 1;
        $DDFire = 1;
        $DDWater = 1;
        $DDElectric = 1;
        $DDGrass = 1;
        $DDIce = 1;
        $DDFighting = 1;
        $DDPoison = 1;
        $DDGround = 1;
        $DDFlying = 1;
        $DDPsychic = 1;
        $DDBug = 1;
        $DDRock = 1;
        $DDGhost = 1;
        $DDDragon = 1;
        $DDDark = 1;
        $DDSteel = 1;
        
        damageDone($monster->type1, $monster->type2, $DDNormal, $DDFire, $DDWater, $DDElectric, $DDGrass, $DDIce, $DDFighting, $DDPoison, $DDGround, $DDFlying, $DDPsychic, $DDBug, $DDRock, $DDGhost, $DDDragon, $DDDark, $DDSteel);
        @endphp


        <table width='100%' align='center' cellspacing='3'>
            <tr>
                <th colspan='17'>Damage taken</th>
            </tr>
            <tr>
                <td width=5% class='center'><img src='/storage/images/types/Normal.png' alt='Normal' title='Normal'></td>
                <td width=5% class='center'><img src='/storage/images/types/Fire.png' alt='Fire' title='Fire'></td>
                <td width=5% class='center'><img src='/storage/images/types/Water.png' alt='Water' title='Water'></td>
                <td width=5% class='center'><img src='/storage/images/types/Electric.png' alt='Electric' title='Electric'></td>
                <td width=5% class='center'><img src='/storage/images/types/Grass.png' alt='Grass' title='Grass'></td>
                <td width=5% class='center'><img src='/storage/images/types/Ice.png' alt='Ice' title='Ice'></td>
                <td width=5% class='center'><img src='/storage/images/types/Fighting.png' alt='Fighting' title='Fighting'></td>
                <td width=5% class='center'><img src='/storage/images/types/Poison.png' alt='Poison' title='Poison'></td>
                <td width=5% class='center'><img src='/storage/images/types/Ground.png' alt='Ground' title='Ground'></td>
                <td width=5% class='center'><img src='/storage/images/types/Flying.png' alt='Flying' title='Flying'></td>
                <td width=5% class='center'><img src='/storage/images/types/Psychic.png' alt='Psychic' title='Psychic'></td>
                <td width=5% class='center'><img src='/storage/images/types/Bug.png' alt='Bug' title='Bug'></td>
                <td width=5% class='center'><img src='/storage/images/types/Rock.png' alt='Rock' title='Rock'></td>
                <td width=5% class='center'><img src='/storage/images/types/Ghost.png' alt='Ghost' title='Ghost'></td>
                <td width=5% class='center'><img src='/storage/images/types/Dragon.png' alt='Dragon' title='Dragon'></td>
                <td width=5% class='center'><img src='/storage/images/types/Dark.png' alt='Dark' title='Dark'></td>
                <td width=5% class='center'><img src='/storage/images/types/Steel.png' alt='Steel' title='Steel'></td>
            </tr>
            <tr>
                <td width=5% class='center'>*{{$DTNormal}}</td>
                <td width=5% class='center'>*{{$DTFire}}</td>
                <td width=5% class='center'>*{{$DTWater}}</td>
                <td width=5% class='center'>*{{$DTElectric}}</td>
                <td width=5% class='center'>*{{$DTGrass}}</td>
                <td width=5% class='center'>*{{$DTIce}}</td>
                <td width=5% class='center'>*{{$DTFighting}}</td>
                <td width=5% class='center'>*{{$DTPoison}}</td>
                <td width=5% class='center'>*{{$DTGround}}</td>
                <td width=5% class='center'>*{{$DTFlying}}</td>
                <td width=5% class='center'>*{{$DTPsychic}}</td>
                <td width=5% class='center'>*{{$DTBug}}</td>
                <td width=5% class='center'>*{{$DTRock}}</td>
                <td width=5% class='center'>*{{$DTGhost}}</td>
                <td width=5% class='center'>*{{$DTDragon}}</td>
                <td width=5% class='center'>*{{$DTDark}}</td>
                <td width=5% class='center'>*{{$DTSteel}}</td>
            </tr>
        </table>

        <table width='100%' align='center' cellspacing='3'>
            <tr><th colspan='17'>Damage done</th></tr>
            <tr><td width=5% class='center'><img src='/storage/images/types/Normal.png' alt='Normal' title='Normal'></td>
            <td width=5% class='center'><img src='/storage/images/types/Fire.png' alt='Fire' title='Fire'></td>
            <td width=5% class='center'><img src='/storage/images/types/Water.png' alt='Water' title='Water'></td>
            <td width=5% class='center'><img src='/storage/images/types/Electric.png' alt='Electric' title='Electric'></td>
            <td width=5% class='center'><img src='/storage/images/types/Grass.png' alt='Grass' title='Grass'></td>
            <td width=5% class='center'><img src='/storage/images/types/Ice.png' alt='Ice' title='Ice'></td>
            <td width=5% class='center'><img src='/storage/images/types/Fighting.png' alt='Fighting' title='Fighting'></td>
            <td width=5% class='center'><img src='/storage/images/types/Poison.png' alt='Poison' title='Poison'></td>
            <td width=5% class='center'><img src='/storage/images/types/Ground.png' alt='Ground' title='Ground'></td>
            <td width=5% class='center'><img src='/storage/images/types/Flying.png' alt='Flying' title='Flying'></td>
            <td width=5% class='center'><img src='/storage/images/types/Psychic.png' alt='Psychic' title='Psychic'></td>
            <td width=5% class='center'><img src='/storage/images/types/Bug.png' alt='Bug' title='Bug'></td>
            <td width=5% class='center'><img src='/storage/images/types/Rock.png' alt='Rock' title='Rock'></td>
            <td width=5% class='center'><img src='/storage/images/types/Ghost.png' alt='Ghost' title='Ghost'></td>
            <td width=5% class='center'><img src='/storage/images/types/Dragon.png' alt='Dragon' title='Dragon'></td>
            <td width=5% class='center'><img src='/storage/images/types/Dark.png' alt='Dark' title='Dark'></td>
            <td width=5% class='center'><img src='/storage/images/types/Steel.png' alt='Steel' title='Steel'></td></tr>
            <tr><td width=5% class='center'>*{{$DDNormal}}</td>
            <td width=5% class='center'>*{{$DDFire}}</td>
            <td width=5% class='center'>*{{$DDWater}}</td>
            <td width=5% class='center'>*{{$DDElectric}}</td>
            <td width=5% class='center'>*{{$DDGrass}}</td>
            <td width=5% class='center'>*{{$DDIce}}</td>
            <td width=5% class='center'>*{{$DDFighting}}</td>
            <td width=5% class='center'>*{{$DDPoison}}</td>
            <td width=5% class='center'>*{{$DDGround}}</td>
            <td width=5% class='center'>*{{$DDFlying}}</td>
            <td width=5% class='center'>*{{$DDPsychic}}</td>
            <td width=5% class='center'>*{{$DDBug}}</td>
            <td width=5% class='center'>*{{$DDRock}}</td>
            <td width=5% class='center'>*{{$DDGhost}}</td>
            <td width=5% class='center'>*{{$DDDragon}}</td>
            <td width=5% class='center'>*{{$DDDark}}</td>
            <td width=5% class='center'>*{{$DDSteel}}</td></tr></table>


            <table width='100%' align='center' cellspacing='3'>				
                @forelse ($evolutions as $evolution)
                    <tr><td><center><img src='/storage/images/front_normal/{{$monster->id}}.png' alt='$name' title='$name'></center></td>
                        <td><center>{{$evolution->method}}</center></td>
                        <td><center><a href='pokemon.php?id={{$evolution->targetMonsterId}}'><img src='/storage/images/front_normal/{{$evolution->targetMonsterId}}.png' alt='{{ $evolution->name }}' title='{{ $evolution->name }}'></a></center></td>
                    </tr>
                @empty
                    <tr>
                        <th>Evolution</th>
                    </tr>
                    <tr>
                        <td>This Pokemon not evolves.</td>
                    </tr>
                @endforelse              

            </table>				 
            
    </div>


@endsection