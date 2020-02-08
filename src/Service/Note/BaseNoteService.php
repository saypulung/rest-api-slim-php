<?php declare(strict_types=1);

namespace App\Service\Note;

use App\Service\BaseService;
use App\Service\RedisService;
use App\Repository\NoteRepository;

class BaseNoteService extends BaseService
{
    const REDIS_KEY = 'note:%s';

    protected $noteRepository;

    protected $redisService;

    public function __construct(NoteRepository $noteRepository, RedisService $redisService)
    {
        $this->noteRepository = $noteRepository;
        $this->redisService = $redisService;
    }

    public function checkAndGetNote(int $noteId)
    {
        return $this->noteRepository->checkAndGetNote($noteId);
    }
}
