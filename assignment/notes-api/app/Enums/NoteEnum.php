<?php


namespace App\Enums;


class NoteEnum
{
    //Using const here since my IDE doesn't seem to support enum from php 8.1
    const NOTE_TYPE_TEXT = 'text';
    const NOTE_TYPE_LIST = 'list';
}
