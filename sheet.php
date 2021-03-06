<?php 
session_start();
include_once("connection.php");
print_r($_POST);
if(empty($_POST['char'])){}
else{$_SESSION['char']=$_POST['char'];}
if(empty($_SESSION['char'])){
  header('Location: selectchar.php');
  die();}

/*echo($_SESSION["char"]."<br>");
echo("<br>");
echo(gettype($_SESSION["char"]));*/

#arrays
$userA=array();
$charA=array();
$classA=array();

$users = $conn->prepare("SELECT users.UserID as id, users.Username as username, users.Email as email
FROM users
WHERE UserID=:user
");
$users->bindParam(':user', $_SESSION['loggedinuser']);
$users->execute();

while ($row = $users->fetch(PDO::FETCH_ASSOC))
  {
    array_push($userA, $row['id'], $row['username'], $row['email']);
  }

$char = $conn->prepare("SELECT *
FROM characters
WHERE CharID=:chara
");
$char->bindParam(':chara', $_SESSION['char']);
$char->execute();
$_SESSION["charid"]=$_SESSION['char'];

while ($row = $char->fetch(PDO::FETCH_ASSOC))
  {
    array_push($charA, $row['CharName'], $row['Xp'], $row['BackgroundID'], $row['PlayerName'], $row['Strength'], $row['Dexterity'], $row['Constitution'], $row['Intelligence'], $row['Wisdom'], $row['Charisma']);
  }

$class = $conn->prepare("SELECT *
FROM charhasclass
INNER JOIN class
ON charhasclass.ClassID=class.ClassID
WHERE CharID=:chara
");
$class->bindParam(':chara', $_SESSION['char']);
$class->execute();

while ($row = $class->fetch(PDO::FETCH_ASSOC))
  {
    array_push($classA, $row['ClassID'], $row['ClassName']);
  }


function setscore($num, $charA) {
  echo('value="'.$charA[$num].'"/> ');
  $mod=(intval($charA[$num])-10)/2;
  if ($mod > -0.1){echo("+".round($mod,0,PHP_ROUND_HALF_DOWN));}
  else{echo(round($mod,0,PHP_ROUND_HALF_UP));}
}
?>


<form class="charsheet" action="savesheet.php" method="post">
  <header>
    <section class="charname">
      <label for="charname">Character Name: </label><input name="charname" value=
      <?php
        echo($charA[0]);
      ?>><br>
      <a href="http://localhost/Coursework/spells.php">Spells</a> (Note: Only do this once everything is saved.)
      <br>
      <a href="http://localhost/Coursework/selectchar.php">Return</a>
    </section>
    <section class="misc">
      <ul>
        <li>
        Class: 
        <select name="class" id="class">
          <?php
            $classes = $conn->prepare("SELECT *
            FROM class
            ");
            $classes->execute();
            #print_r($classes);
            while ($row = $classes->fetch(PDO::FETCH_ASSOC))
            {
              if($row['ClassID']==$classA[0]){
                echo('<option value="'.$row['ClassID'].'" selected>'.$row['ClassName'].'</option>');
                $_SESSION['ClassID']=$row['ClassID'];
              }
              else{
                echo('<option value="'.$row['ClassID'].'">'.$row['ClassName'].'</option>');
              }
            }
            ?>
        </select>
        </li>
        <li>
        Background:
        <select name="background" id="background">
          <?php
            $backgrounds = $conn->prepare("SELECT *
            FROM backgrounds
            ");
            $backgrounds->execute();
            #print_r($backgrounds);
            while ($row = $backgrounds->fetch(PDO::FETCH_ASSOC))
            {
              if($row['BackgroundID']==$charA[2]){
                echo('<option value="'.$row['BackgroundID'].'" selected>'.$row['BackgroundName'].'</option>');
              }
              else{
                echo('<option value="'.$row['BackgroundID'].'">'.$row['BackgroundName'].'</option>');
              }
            }
            ?>
        </select>

        </li>
        <li>
          <label for="playername">Player Name: </label><input name="playername"
          <?php 
          if (empty($charA[3])){echo('placeholder="Matthew"');}
          else{
          echo('value="'.$charA[3].'"');
          }
          ?>
          >

        </li>
        <li>
          <label for="ancestry">Ancestry</label><input name="ancestry" placeholder="Mountain Dwarf" />
        </li>
        <li>
          <label for="alignment">Alignment</label><input name="alignment" placeholder="Neutral Good" />
        </li>
        <li>
        <label for="experiencepoints">Experience Points</label><input name="experiencepoints" value=
          <?php
          echo('"'.$charA[1].'" />');
          $xp=$charA[1];
          ?>
        </li>
        <li>
            <?php
                if ($xp<300){$level=1;}
                elseif ($xp>=300 and $xp<900){$level=2;}
                elseif ($xp>=900 and $xp<2700){$level=3;}
                elseif ($xp>=2700 and $xp<6500){$level=4;}
                elseif ($xp>=6500 and $xp<100000){$level=5;}
                echo('Level: '.$level);
                $_SESSION["level"]=$level;
            ?>
        </li>
        </ul>
        <input type="submit" value="Save">

    </section>
  </header>
  <main>
    <section>
      <section class="attributes">
        <div class="scores">
          <ul>
            <li>
              <div class="score">
                <label for="strengthscore">Strength</label><input name="strengthscore" 
                <?php 
                  setscore(4, $charA)
                ?>
              <div>
            </li>
            <li>
            <div class="score">
                <label for="dexterityscore">Dexterity</label><input name="dexterityscore" 
                <?php 
                  setscore(5, $charA)
                ?>
              <div>
            </li>
            <li>
            <div class="score">
                <label for="constitutionscore">Constitution</label><input name="constitutionscore" 
                <?php 
                  setscore(6, $charA)
                ?>
              <div>
            </li>
            <li>
            <div class="score">
                <label for="intelligencescore">Intelligence</label><input name="intelligencescore" 
                <?php 
                  setscore(7, $charA)
                ?>
              <div>
            </li>
            <li>
              <div class="score">
                <label for="wisdomscore">Wisdom</label><input name="wisdomscore" 
                <?php 
                  setscore(8, $charA)
                ?>
              <div>
            </li>
            <li>
              <div class="score">
                <label for="charismascore">Charisma</label><input name="charismascore" 
                <?php 
                  setscore(9, $charA)
                ?>
              <div>
            </li>
          </ul>
          Randomise (4d6 drop lowest): 
          <input name="randomstat" type="checkbox" />
        </div>
        <div class="attr-applications">
          <div class="inspiration box">
            <div class="label-container">
              <label for="inspiration">Inspiration</label>
            </div>
            <input name="inspiration" type="checkbox" />
          </div>
          <div class="proficiencybonus box">
            <div class="label-container">
              Proficiency Bonus: 
              <?php
              $_SESSION['profbonus']=2+floor(($level-1)/4);
              echo('+'.$_SESSION['profbonus'])
              ?>
            </div>
          </div>
          <div class="saves list-section box">
          <div class="label">
              Saving Throws | Prof | Auto?
            </div>
            <ul>
              <li>
                <label for="Strength-save">Strength</label><input name="Strength-save" placeholder="+0" type="text" /><input name="Strength-save-prof" type="checkbox" /><input name="Str-save-auto" type="checkbox" />
              </li>
              <li>
                <label for="Dexterity-save">Dexterity</label><input name="Dexterity-save" placeholder="+0" type="text" /><input name="Dexterity-save-prof" type="checkbox" /><input name="Dex-save-auto" type="checkbox" />
              </li>
              <li>
                <label for="Constitution-save">Constitution</label><input name="Constitution-save" placeholder="+0" type="text" /><input name="Constitution-save-prof" type="checkbox" /><input name="Con-save-auto" type="checkbox" />
              </li>
              <li>
                <label for="Wisdom-save">Wisdom</label><input name="Wisdom-save" placeholder="+0" type="text" /><input name="Wisdom-save-prof" type="checkbox" /><input name="Wis-save-auto" type="checkbox" />
              </li>
              <li>
                <label for="Intelligence-save">Intelligence</label><input name="Intelligence-save" placeholder="+0" type="text" /><input name="Intelligence-save-prof" type="checkbox" /><input name="Int-save-auto" type="checkbox" />
              </li>
              <li>
                <label for="Charisma-save">Charisma</label><input name="Charisma-save" placeholder="+0" type="text" /><input name="Charisma-save-prof" type="checkbox" /><input name="Cha-save-auto" type="checkbox" />
              </li>
            </ul>
          </div>
          <div class="skills list-section box">
            <ul>
              <li>
                <label for="Acrobatics">Acrobatics <span class="skill">(Dex)</span></label><input name="Acrobatics" placeholder="+0" type="text" /><input name="Acrobatics-prof" type="checkbox" />
              </li>
              <li>
                <label for="Animal Handling">Animal Handling <span class="skill">(Wis)</span></label><input name="Animal Handling" placeholder="+0" type="text" /><input name="Animal Handling-prof" type="checkbox" />
              </li>
              <li>
                <label for="Arcana">Arcana <span class="skill">(Int)</span></label><input name="Arcana" placeholder="+0" type="text" /><input name="Arcana-prof" type="checkbox" />
              </li>
              <li>
                <label for="Athletics">Athletics <span class="skill">(Str)</span></label><input name="Athletics" placeholder="+0" type="text" /><input name="Athletics-prof" type="checkbox" />
              </li>
              <li>
                <label for="Deception">Deception <span class="skill">(Cha)</span></label><input name="Deception" placeholder="+0" type="text" /><input name="Deception-prof" type="checkbox" />
              </li>
              <li>
                <label for="History">History <span class="skill">(Int)</span></label><input name="History" placeholder="+0" type="text" /><input name="History-prof" type="checkbox" />
              </li>
              <li>
                <label for="Insight">Insight <span class="skill">(Wis)</span></label><input name="Insight" placeholder="+0" type="text" /><input name="Insight-prof" type="checkbox" />
              </li>
              <li>
                <label for="Intimidation">Intimidation <span class="skill">(Cha)</span></label><input name="Intimidation" placeholder="+0" type="text" /><input name="Intimidation-prof" type="checkbox" />
              </li>
              <li>
                <label for="Investigation">Investigation <span class="skill">(Int)</span></label><input name="Investigation" placeholder="+0" type="text" /><input name="Investigation-prof" type="checkbox" />
              </li>
              <li>
                <label for="Medicine">Medicine <span class="skill">(Wis)</span></label><input name="Medicine" placeholder="+0" type="text" /><input name="Medicine-prof" type="checkbox" />
              </li>
              <li>
                <label for="Nature">Nature <span class="skill">(Int)</span></label><input name="Nature" placeholder="+0" type="text" /><input name="Nature-prof" type="checkbox" />
              </li>
              <li>
                <label for="Perception">Perception <span class="skill">(Wis)</span></label><input name="Perception" placeholder="+0" type="text" /><input name="Perception-prof" type="checkbox" />
              </li>
              <li>
                <label for="Performance">Performance <span class="skill">(Cha)</span></label><input name="Performance" placeholder="+0" type="text" /><input name="Performance-prof" type="checkbox" />
              </li>
              <li>
                <label for="Persuasion">Persuasion <span class="skill">(Cha)</span></label><input name="Persuasion" placeholder="+0" type="text" /><input name="Persuasion-prof" type="checkbox" />
              </li>
              <li>
                <label for="Religion">Religion <span class="skill">(Int)</span></label><input name="Religion" placeholder="+0" type="text" /><input name="Religion-prof" type="checkbox" />
              </li>
              <li>
                <label for="Sleight of Hand">Sleight of Hand <span class="skill">(Dex)</span></label><input name="Sleight of Hand" placeholder="+0" type="text" /><input name="Sleight of Hand-prof" type="checkbox" />
              </li>
              <li>
                <label for="Stealth">Stealth <span class="skill">(Dex)</span></label><input name="Stealth" placeholder="+0" type="text" /><input name="Stealth-prof" type="checkbox" />
              </li>
              <li>
                <label for="Survival">Survival <span class="skill">(Wis)</span></label><input name="Survival" placeholder="+0" type="text" /><input name="Survival-prof" type="checkbox" />
              </li>
            </ul>
            <div class="label">
              Skills
            </div>
          </div>
        </div>
      </section>
      <div class="passive-perception box">
        <div class="label-container">
          <label for="passiveperception">Passive Wisdom (Perception)</label>
        </div>
        <input name="passiveperception" placeholder="10" />
      </div>
      <div class="otherprofs box textblock">
        <label for="otherprofs">Other Proficiencies and Languages</label><textarea name="otherprofs"></textarea>
      </div>
    </section>
    <section>
      <section class="combat">
        <div class="armorclass">
          <div>
            <label for="ac">Armor Class</label><input name="ac" placeholder="10" type="text" />
          </div>
        </div>
        <div class="initiative">
          <div>
            <label for="initiative">Initiative</label><input name="initiative" placeholder="+0" type="text" />
          </div>
        </div>
        <div class="speed">
          <div>
            <label for="speed">Speed</label><input name="speed" placeholder="30" type="text" />
          </div>
        </div>
        <div class="hp">
          <div class="regular">
            <div class="max">
              <label for="maxhp">Hit Point Maximum</label><input name="maxhp" placeholder="10" type="text" />
            </div>
            <div class="current">
              <label for="currenthp">Current Hit Points</label><input name="currenthp" type="text" />
            </div>
          </div>
          <div class="temporary">
            <label for="temphp">Temporary Hit Points</label><input name="temphp" type="text" />
          </div>
        </div>
        <div class="hitdice">
          <div>
            <div class="total">
              <label for="totalhd">Total</label><input name="totalhd" placeholder="2d10" type="text" />
            </div>
            <div class="remaining">
              <label for="remaininghd">Hit Dice</label><input name="remaininghd" type="text" />
            </div>
          </div>
        </div>
        <div class="deathsaves">
          <div>
            <div class="label">
              <label>Death Saves</label>
            </div>
            <div class="marks">
              <div class="deathsuccesses">
                <label>Successes</label>
                <div class="bubbles">
                  <input name="deathsuccess1" type="checkbox" />
                  <input name="deathsuccess2" type="checkbox" />
                  <input name="deathsuccess3" type="checkbox" />
                </div>
              </div>
              <div class="deathfails">
                <label>Failures</label>
                <div class="bubbles">
                  <input name="deathfail1" type="checkbox" />
                  <input name="deathfail2" type="checkbox" />
                  <input name="deathfail3" type="checkbox" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="attacksandspellcasting">
        <div>
          <label>Attacks & Spellcasting</label>
          <table>
            <thead>
              <tr>
                <th>
                  Name
                </th>
                <th>
                  Atk Bonus
                </th>
                <th>
                  Damage/Type
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <input name="atkname1" type="text" />
                </td>
                <td>
                  <input name="atkbonus1" type="text" />
                </td>
                <td>
                  <input name="atkdamage1" type="text" />
                </td>
              </tr>
              <tr>
                <td>
                  <input name="atkname2" type="text" />
                </td>
                <td>
                  <input name="atkbonus2" type="text" />
                </td>
                <td>
                  <input name="atkdamage2" type="text" />
                </td>
              </tr>
              <tr>
                <td>
                  <input name="atkname3" type="text" />
                </td>
                <td>
                  <input name="atkbonus3" type="text" />
                </td>
                <td>
                  <input name="atkdamage3" type="text" />
                </td>
              </tr>
            </tbody>
          </table>
          <textarea></textarea>
        </div>
      </section>
      <section class="equipment">
        <div>
          <label>Equipment</label>
          <div class="money">
            <ul>
              <li>
                <label for="cp">cp</label><input name="cp" />
              </li>
              <li>
                <label for="sp">sp</label><input name="sp" />
              </li>
              <li>
                <label for="ep">ep</label><input name="ep" />
              </li>
              <li>
                <label for="gp">gp</label><input name="gp" />
              </li>
              <li>
                <label for="pp">pp</label><input name="pp" />
              </li>
            </ul>
          </div>
          <textarea placeholder="Equipment list here"></textarea>
        </div>
      </section>
    </section>
    <section>
      <section class="flavor">
        <div class="personality">
          <label for="personality">Personality</label><textarea name="personality"></textarea>
        </div>
        <div class="ideals">
          <label for="ideals">Ideals</label><textarea name="ideals"></textarea>
        </div>
        <div class="bonds">
          <label for="bonds">Bonds</label><textarea name="bonds"></textarea>
        </div>
        <div class="flaws">
          <label for="flaws">Flaws</label><textarea name="flaws"></textarea>
        </div>
      </section>
      <section class="features">
        <div>
          <label for="features">Features & Traits</label><textarea name="features"></textarea>
        </div>
      </section>
    </section>
  </main>
</form>