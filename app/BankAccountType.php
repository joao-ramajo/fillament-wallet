<?php

namespace App;

enum BankAccountType: string
{
    case Checking = 'checking';
    case Savings = 'savings';
    case Credit = 'credit';
}
