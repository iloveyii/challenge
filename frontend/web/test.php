<?php
function isPrime($x)
{
	if($x == 1)
	{
		return false;
	}

	foreach (range(2, $x - 1) as $divisor)
	{
		if ($x % $divisor == 0)
		{
			return false;
		}
	}

	return true;
}

echo isPrime(17) ? 'Yes': 'No';
echo PHP_EOL;