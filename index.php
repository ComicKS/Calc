<?php
function tambah($angka1, $angka2)
{
	return $angka1 + $angka2;
}

function kurang($angka1, $angka2)
{
	return $angka1 - $angka2;
}

function kali($angka1, $angka2)
{
	return $angka1 * $angka2;
}

function bagi($angka1, $angka2)
{
	return $angka1 / $angka2;
}

$hasil = '';
$pesan = '';
$angka1 = '';
$angka2 = '';
$operasi = 'tambah';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$angka1 = $_POST['angka1'] ?? '';
	$angka2 = $_POST['angka2'] ?? '';
	$operasi = $_POST['operasi'] ?? 'tambah';

	if (is_numeric($angka1) && is_numeric($angka2)) {
		$angka1 = (float) $angka1;
		$angka2 = (float) $angka2;

		if ($operasi === 'tambah') {
			$hasil = tambah($angka1, $angka2);
		} elseif ($operasi === 'kurang') {
			$hasil = kurang($angka1, $angka2);
		} elseif ($operasi === 'kali') {
			$hasil = kali($angka1, $angka2);
		} elseif ($operasi === 'bagi') {
			if ($angka2 == 0) {
				$pesan = 'Tidak bisa membagi dengan nol.';
			} else {
				$hasil = bagi($angka1, $angka2);
			}
		}
	} else {
		$pesan = 'Masukkan dua angka yang valid.';
	}
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Calc.</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
			margin: 30px;
		}

		.kalkulator {
			max-width: 400px;
			margin: 0 auto;
			padding: 20px;
			background-color: white;
			border: 1px solid #ccc;
		}

		label, input, select, button {
			display: block;
			width: 100%;
			box-sizing: border-box;
			margin-top: 8px;
		}

		input, select, button {
			padding: 8px;
		}

		button {
			margin-top: 16px;
		}

		.hasil {
			margin-top: 18px;
		}
	</style>
</head>
<body>
	<div class="kalkulator">
		<h1>Calc.</h1>
		<form method="post">
			<label for="angka1">Number 1</label>
			<input type="number" step="any" id="angka1" name="angka1" value="<?= htmlspecialchars((string) $angka1, ENT_QUOTES, 'UTF-8') ?>" required>

			<label for="angka2">Number 2</label>
			<input type="number" step="any" id="angka2" name="angka2" value="<?= htmlspecialchars((string) $angka2, ENT_QUOTES, 'UTF-8') ?>" required>

			<label for="operasi">Operation</label>
			<select id="operasi" name="operasi">
				<option value="tambah" <?= $operasi === 'tambah' ? 'selected' : '' ?>>Addition (+)</option>
				<option value="kurang" <?= $operasi === 'kurang' ? 'selected' : '' ?>>Subtraction (-)</option>
				<option value="kali" <?= $operasi === 'kali' ? 'selected' : '' ?>>Multiplication (*)</option>
				<option value="bagi" <?= $operasi === 'bagi' ? 'selected' : '' ?>>Division (/)</option>
			</select>

			<button type="submit">Calculate</button>
		</form>

		<div class="hasil">
			<?php if ($pesan !== ''): ?>
				<p><?= htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8') ?></p>
			<?php elseif ($hasil !== ''): ?>
				<p>Result: <?= htmlspecialchars((string) $hasil, ENT_QUOTES, 'UTF-8') ?></p>
			<?php endif; ?>
		</div>
	</div>
</body>
</html>
