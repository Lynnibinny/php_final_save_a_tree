<form action="guestbook.php" method="post">
    <fieldset>
        <legend>&nbsp;Ins Gästebuch Eintragen&nbsp;</legend>
		  <table>
				<tr>
					<th>Name:</th><td><input type="text" name="Autor" /></td>
				</tr>
				<tr>
					<th>Betreff:</th><td><input type="text" name="Betreff" /></td>
				</tr>
				<tr>
					<th>Text:</th><td><textarea name="Inhalt" rows="6" cols="40"></textarea></td>
				</tr>
				<tr>
					<th></th>
					<td>
						<?php
							$nbr1 = rand(1,9);
							$nbr2 = rand(1,9);
							$_SESSION['result'] = $nbr1 + $nbr2;
							echo $nbr1." + ".$nbr2." = \n";
						?>
					</td>
				</tr>
				<tr>
					<th></th><td><input type="text" name="Antwort"/></td>
				</tr>
				<tr>
					<th></th><td><input type="submit" name="formaction" value="Eintragen" /></td>
				</tr>
			</table>
    </fieldset>
</form>
