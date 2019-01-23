<?php

namespace App\Service;

use App\Exception\NoteException;
use App\Repository\NoteRepository;
use App\Validation\NoteValidation as vs;

/**
 * Notes Service.
 */
class NoteService extends BaseService
{
    /**
     * @var NoteRepository
     */
    protected $noteRepository;

    /**
     * @param NoteRepository $noteRepository
     */
    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    /**
     * Check if the note exists.
     *
     * @param int $noteId
     * @return object
     */
    protected function checkNote($noteId)
    {
        return $this->noteRepository->checkNote($noteId);
    }

    /**
     * Get all notes.
     *
     * @return array
     */
    public function getNotes()
    {
        return $this->noteRepository->getNotes();
    }

    /**
     * Get one note by id.
     *
     * @param int $noteId
     * @return object
     */
    public function getNote($noteId)
    {
        return $this->checkNote($noteId);
    }

    /**
     * Search notes by name.
     *
     * @param string $notesName
     * @return array
     */
    public function searchNotes($notesName)
    {
        return $this->noteRepository->searchNotes($notesName);
    }

    /**
     * Create a note.
     *
     * @param array $input
     * @return object
     */
    public function createNote($input)
    {
        $data = vs::validateInputOnCreateNote($input);

        return $this->noteRepository->createNote($data);
    }

    /**
     * Update a note.
     *
     * @param array $input
     * @param int $noteId
     * @return object
     */
    public function updateNote($input, $noteId)
    {
        $checkNote = $this->checkNote($noteId);
        if (!isset($input['name'])) {
            throw new NoteException(NoteException::NOTE_INFO_REQUIRED, 400);
        }
        $data = new \stdClass();
        $data->name = vs::validateNameOnUpdateNote($input, $checkNote);
        $data->description = vs::validateDescriptionOnUpdateNote($input, $checkNote);

        return $this->noteRepository->updateNote($data, $noteId);
    }

    /**
     * Delete a note.
     *
     * @param int $noteId
     * @return string
     */
    public function deleteNote($noteId)
    {
        $this->checkNote($noteId);

        return $this->noteRepository->deleteNote($noteId);
    }
}