<?php

namespace App\Enums;

enum TaskStatus: string
{
    case TODO = 'To Do';
    case IN_PROGRESS = 'In Progress';
    case DONE = 'Done';
    case DELAYED = 'Delayed';
    case CANCELLED = 'Cancelled';
}
