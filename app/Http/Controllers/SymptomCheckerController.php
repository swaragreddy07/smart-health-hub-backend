<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SymptomCheckerController extends Controller
{
    public function checkSymptoms(Request $request)
    {
        // Validate input
        $request->validate([
            'symptoms' => 'required',
            // Add more validation rules as needed
        ]);

        // Define guidance for each symptom
        $symptomGuidance = [
            'Cough' => [
                'Get plenty of rest.',
                'Stay hydrated by drinking water, warm broth, or tea.',
                'Use a humidifier or take a hot shower to soothe your throat.',
                'Try over-the-counter cough medications to suppress coughing, if necessary.',
                // Add more guidance for cough as needed
            ],
            'Sneezing' => [
                'Cover your mouth and nose with a tissue when you sneeze.',
                'Wash your hands frequently with soap and water.',
                'Avoid close contact with others to prevent spreading germs.',
                'Consider taking over-the-counter antihistamines if allergies are causing sneezing.',
                // Add more guidance for sneezing as needed
            ],
            'Sore throat' => [
                'Drink warm liquids like tea with honey or broth.',
                'Gargle with salt water to soothe a sore throat.',
                'Use throat lozenges or sprays to numb the throat temporarily.',
                'Avoid irritants like smoking or air pollution.',
                // Add more guidance for sore throat as needed
            ],
            'Fatigue' => [
                'Ensure you\'re getting enough sleep, aiming for 7-9 hours per night.',
                'Establish a regular sleep schedule and practice good sleep hygiene.',
                'Eat a balanced diet rich in nutrients.',
                'Engage in regular physical activity, as it can improve energy levels.',
                'If fatigue persists despite lifestyle changes, consult a healthcare professional to rule out underlying medical conditions like anemia or thyroid disorders.',
                // Add more guidance for fatigue as needed
            ],
            'Headache' => [
                'Identify triggers such as stress, lack of sleep, or certain foods.',
                'Practice relaxation techniques like deep breathing or meditation.',
                'Stay hydrated and maintain regular meals.',
                'Over-the-counter pain relievers like acetaminophen or ibuprofen can help, but avoid excessive use.',
                'If headaches are severe, frequent, or interfere with daily activities, consult a healthcare professional for evaluation.',
                // Add more guidance for headache as needed
            ],
            'Low-grade fever' => [
                'Get plenty of rest.',
                'Drink fluids to stay hydrated.',
                'Take over-the-counter fever reducers like acetaminophen or ibuprofen, if necessary.',
                'Monitor your temperature regularly and seek medical attention if fever persists or worsens.',
                // Add more guidance for low-grade fever as needed
            ],
            'Watery eyes' => [
                'Avoid rubbing your eyes, as it can worsen irritation.',
                'Use artificial tears or eye drops to lubricate the eyes and relieve dryness.',
                'Avoid allergens or irritants that may trigger watery eyes, if possible.',
                'If symptoms persist or worsen, consult a healthcare professional for evaluation and treatment.',
                // Add more guidance for watery eyes as needed
            ],
            'Difficulty breathing' => [
                'Sit or lie down in a comfortable position.',
                'Practice deep breathing exercises.',
                'If shortness of breath is sudden, severe, or accompanied by chest pain or dizziness, seek emergency medical attention.',
                'If symptoms persist or worsen, consult a healthcare professional for evaluation and treatment.',
                // Add more guidance for difficulty breathing as needed
            ],
            'Chest pain' => [
                'If experiencing sudden, severe chest pain, call emergency services immediately.',
                'Avoid strenuous activity and rest in a comfortable position.',
                'If pain is mild or moderate but persists, seek medical attention promptly to rule out serious conditions like a heart attack or pulmonary embolism.',
                // Add more guidance for chest pain as needed
            ],
            'Nausea' => [
                'Eat small, bland meals and avoid spicy or greasy foods.',
                'Stay hydrated by sipping clear fluids like water, broth, or electrolyte drinks.',
                'Avoid lying down immediately after eating.',
                'Over-the-counter medications like antacids or antiemetics may provide relief, but consult a healthcare professional before use.',
                'If nausea is severe, persistent, or accompanied by vomiting, consult a healthcare professional for evaluation.',
                // Add more guidance for nausea as needed
            ],
            'Confusion' => [
                'Ensure the person is in a safe environment and free from hazards.',
                'Reorient the person by providing simple, clear instructions and reminders.',
                'Monitor vital signs and seek medical attention if confusion persists or worsens.',
                'Consider underlying causes such as medication side effects, dehydration, or infection.',
                // Add more guidance for confusion as needed
            ],
            // Add more symptoms and guidance as needed
        ];
        // Get input symptoms from the request
        $inputSymptoms = $request->input('symptoms');

        // Initialize array to store guidance for matched symptoms
        $symptomGuidanceForUser = [];

        // Loop through input symptoms and gather guidance
        foreach ($inputSymptoms as $symptom) {
            // Check if guidance exists for the symptom
            if (array_key_exists($symptom, $symptomGuidance)) {
                // Add guidance for the symptom to the array
                $symptomGuidanceForUser[$symptom] = $symptomGuidance[$symptom];
            }
        }

        // Return response with guidance for input symptoms
        return response()->json(['symptom_guidance' => $symptomGuidanceForUser], 200);
    }
}
