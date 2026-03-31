let selectedParty = "";

// Function: selectParty
// Purpose: This runs when a user clicks on a party card.
function selectParty(party) {
    selectedParty = party;

    // 1. Remove the 'selected' styling from all other cards
    document.querySelectorAll(".vote-card").forEach(card => {
        card.classList.remove("selected");
    });

    // 2. Add the 'selected' styling to the clicked card
    event.currentTarget.classList.add("selected");

    // 3. Update the text in the confirmation box
    const partyNameDisplay = document.getElementById("selectedParty");
    partyNameDisplay.innerText = party;

    // Change color based on selection (Orange for NOTA, Green for others)
    partyNameDisplay.style.color = (party === "NOTA") ? "#FF9933" : "#138808";

    // 4. Smoothly scroll down to the confirmation box
    document.querySelector('.confirm-box').scrollIntoView({
        behavior: 'smooth',
        block: 'center'
    });
}

function submitVote() {
    if (!selectedParty) {
        alert("Please select a party first!");
        return;
    }
    if (confirm("Are you sure you want to vote for " + selectedParty + "? You cannot change your vote later.")) {
        document.getElementById("hiddenPartyInput").value = selectedParty;
        document.getElementById("voteForm").submit();
    }
}
