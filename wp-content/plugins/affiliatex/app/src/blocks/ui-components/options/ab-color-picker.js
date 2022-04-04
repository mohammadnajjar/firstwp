import {
    useRef, useState
} from '@wordpress/element'
import { matchValuesWithCondition, normalizeCondition } from 'match-conditions'
import SinglePicker from '../color-picker/single-picker'
import OutsideClickHandler from '../react-outside-click-handler'

const ColorPicker = ({ option, values, value, onChange }) => {
    const [{ isPicking, isTransitioning }, setState] = useState({
        isPicking: null,
        isTransitioning: null,
    })

    const containerRef = useRef()
    const modalRef = useRef()

    return (
        <OutsideClickHandler
            useCapture={false}
            display="inline-block"
            disabled={!isPicking}
            wrapperProps={{
                ref: containerRef,
            }}
            className="app-color-picker-container"
            additionalRefs={[modalRef]}
            onOutsideClick={() => {
                setState(({ isPicking }) => ({
                    isPicking: null,
                    isTransitioning: isPicking,
                }))
            }}>
            {option.pickers
                .filter(
                    (picker) =>
                        !picker.condition ||
                        matchValuesWithCondition(
                            normalizeCondition(picker.condition),
                            values
                        )
                )
                .map((picker) => (
                    <SinglePicker
                        containerRef={containerRef}
                        picker={picker}
                        key={picker.id}
                        option={option}
                        isPicking={isPicking}
                        modalRef={modalRef}
                        isTransitioning={isTransitioning}
                        onPickingChange={(isPicking) =>
                            setState({
                                isTransitioning: picker.id,
                                isPicking,
                            })
                        }
                        stopTransitioning={() =>
                            setState((state) => ({
                                ...state,
                                isTransitioning: false,
                            }))
                        }
                        onChange={(newPicker) =>
                            onChange({
                                ...value,
                                [picker.id]: newPicker,
                            })
                        }
                        value={value[picker.id] || option.value[picker.id]}
                    />
                ))}
        </OutsideClickHandler>
    )
}

export default ColorPicker
