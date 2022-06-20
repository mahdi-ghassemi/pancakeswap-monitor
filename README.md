<br/>
<p align="center">
  <a href="https://php.net/"><img src="https://img.shields.io/badge/php-%23777BB4.svg?style=plastic&logo=php&logoColor=white" alt="PHP"></a>  

</p>
<br/>
<h1> Monitoring PancakeSwap for tracing buy event </h1>

> PHP code only <br/>
> <a href="https://moralis.io/"> Moralis API </a> required

## Problem

In a project, we need to know how many tokens users have bought from the PancakeSwap liquidity pool at each periodic time.
For example, every 15 minutes, how many X tokens are bought from the X-USDT pool.

## Suggested Solution

In this solution, a job cron was created that executes `pool_action.php` every 15 minutes. Using the Moralis logs endpoint API,  pool's transactions are extracted and transactions data are read, and those were  about buying,  their amount were summed togethers. After the calculations, the last transaction of this report is stored in the database, so in the next execution, only the new transactions is calculated and the last transaction is updated again. 


## License

MIT
